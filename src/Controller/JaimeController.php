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
        // 1) CSRF
        $token = (string) $request->request->get('token');
        if (!$this->isCsrfTokenValid('like_'.$id, $token)) {
            return new JsonResponse(['ok' => false, 'error' => 'csrf_invalid'], 403);
        }

        $name = (string) $request->request->get('name', 'Inconnu');

      
        $userId    = $this->getUser()?->getId();
        $anonToken = $request->cookies->get('anon_token') ?? bin2hex(random_bytes(16));
        $setCookie = !$request->cookies->has('anon_token');

        $identity = $userId ? 'u:'.$userId : 'a:'.$anonToken;

        // 4) Collections
        $db        = $this->mongo->selectDatabase($this->dbName);
        $events    = $db->selectCollection('likes_events');    
        $counters  = $db->selectCollection($this->likesCounters); 


        try {
         
            $events->insertOne([
                'animal_id'  => (int) $id,
                'identity'   => $identity,
                'created_at' => new UTCDateTime(),
            ]);

  
            $counters->updateOne(
                ['animal_id' => (int) $id],
                [
                    '$inc' => ['count' => 1],
                    '$setOnInsert' => [
                        'animal_name' => $name,
                        'animal_id'   => (int) $id,
                    ],
                ],
                ['upsert' => true]
            );
        } catch (BulkWriteException $e) {
       
            if ($e->getCode() !== 11000) {
                throw $e;
            }
        }

        $doc   = $counters->findOne(['animal_id' => (int) $id]);
        $count = (int) ($doc['count'] ?? 0);


        $resp = new JsonResponse(['ok' => true, 'id' => $id, 'name' => $name, 'count' => $count]);

        if ($setCookie && !$userId) {
            $cookie = Cookie::create('anon_token', $anonToken, strtotime('+1 year'))
                ->withHttpOnly(true)->withSecure(true)->withSameSite('Lax')->withPath('/');
            $resp->headers->setCookie($cookie);
        }

        return $resp;
    }
}
