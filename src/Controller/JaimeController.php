<?php

namespace App\Controller;

use MongoDB\Client;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Driver\Exception\BulkWriteException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Cookie};
use Symfony\Component\Routing\Annotation\Route;

final class JaimeController extends AbstractController
{
    public function __construct(
        private Client $mongo,
        #[Autowire('%env(MONGODB_DB)%')] private string $dbName,
        #[Autowire('%env(MONGODB_LIKES_COLLECTION)%')] private string $likesCounters // ex: "likes_counters"
    ) {}

    #[Route('/jaime/{id}', name: 'jaime_incrementer', methods: ['POST'])]
    public function incrementer(int $id, Request $request): JsonResponse
    {
        // 1) Vérif CSRF
        $token = (string) $request->request->get('token');
        if (!$this->isCsrfTokenValid('like_'.$id, $token)) {
            return new JsonResponse(['ok' => false, 'error' => 'csrf_invalid'], 403);
        }

        $name = (string) $request->request->get('name', 'Inconnu');

        // 2) Déterminer l'identité (utilisateur connecté ou anonyme avec cookie)
        $userId    = $this->getUser()?->getId();
        $anonToken = $request->cookies->get('anon_token') ?? bin2hex(random_bytes(16));
        $setCookie = !$request->cookies->has('anon_token');
        $identity  = $userId ? 'u:'.$userId : 'a:'.$anonToken;

        // 3) Connexion à la collection
        $db       = $this->mongo->selectDatabase($this->dbName);
        $counters = $db->selectCollection($this->likesCounters);

        try {
            // Empêcher un même utilisateur ou cookie de liker plusieurs fois
            $filter = [
                'animal_id' => (int) $id,
                'liked_by'  => $identity,
            ];

            // Vérifie si déjà liké
            if ($counters->findOne($filter)) {
                return new JsonResponse(['ok' => false, 'error' => 'already_liked'], 409);
            }

            // Incrémente le compteur global + enregistre l'identité
            $counters->updateOne(
                ['animal_id' => (int) $id],
                [
                    '$inc' => ['count' => 1],
                    '$addToSet' => ['liked_by' => $identity],
                    '$setOnInsert' => [
                        'animal_name' => $name,
                        'animal_id'   => (int) $id,
                        'created_at'  => new UTCDateTime(),
                    ],
                ],
                ['upsert' => true]
            );

        } catch (BulkWriteException $e) {
            if ($e->getCode() !== 11000) {
                throw $e;
            }
        }

        // 4) Récupérer le compteur mis à jour
        $doc   = $counters->findOne(['animal_id' => (int) $id]);
        $count = (int) ($doc['count'] ?? 0);

        // 5) Réponse
        $resp = new JsonResponse(['ok' => true, 'id' => $id, 'name' => $name, 'count' => $count]);

        // Si anonyme, set un cookie pour bloquer les prochains likes
        if ($setCookie && !$userId) {
            $cookie = Cookie::create('anon_token', $anonToken, strtotime('+1 year'))
                ->withHttpOnly(true)->withSecure(true)->withSameSite('Lax')->withPath('/');
            $resp->headers->setCookie($cookie);
        }

        return $resp;
    }
}
