<?php

namespace App\Controller;

use MongoDB\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')] 
final class StatsController extends AbstractController
{
    public function __construct(
        private Client $mongo,
        #[Autowire('%env(MONGODB_DB)%')] private string $dbName,
        #[Autowire('%env(MONGODB_LIKES_COLLECTION)%')] private string $likesCollection,
    ) {}

   #[Route('/stats/likes', name: 'stats_likes', methods: ['GET'])]
public function likes(): Response
{
    /** @var \MongoDB\Collection $coll */
    $coll = $this->mongo
        ->selectDatabase($this->dbName)
        ->selectCollection($this->likesCollection);

    /** @var \MongoDB\Driver\Cursor $cursor */
    $cursor = $coll->find([], ['sort' => ['count' => -1]]);


    $docs = iterator_to_array($cursor, false);


    $totalLikes = 0;
    $rows = [];
    foreach ($docs as $d) {
        $id    = (int)($d['animal_id'] ?? 0);
        $name  = (string)($d['animal_name'] ?? ('#'.$id));
        $count = (int)($d['count'] ?? 0);
        $totalLikes += $count;
        $rows[] = ['id'=>$id,'name'=>$name,'count'=>$count];
    }

    return $this->render('stats/likes.html.twig', [
        'dbName'          => $this->dbName,
        'likesCollection' => $this->likesCollection,
        'totalLikes'      => $totalLikes,
        'animalsCnt'      => count($rows),
        'leaderName'      => $rows[0]['name']  ?? '—',
        'leaderCount'     => $rows[0]['count'] ?? 0,
        'tableRows'       => $rows,
    ]);
}
}






