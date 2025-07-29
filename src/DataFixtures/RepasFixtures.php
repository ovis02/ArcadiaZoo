<?php

namespace App\DataFixtures;

use App\Entity\Repas;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use DateTime;

class RepasFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $repasData = [
            ['animal_1', 'petits mammifères, oiseaux', 1.0],
            ['animal_2', 'insectes, fruits', 1.2],
            ['animal_3', 'rongeurs, oeufs', 0.8],
            ['animal_4', 'herbes, graines', 500],
            ['animal_5', 'insectes, feuilles', 150],
            ['animal_6', 'rongeurs, oiseaux', 600],
            ['animal_7', 'poissons, petits mammifères', 900],
            ['animal_8', 'fruits, graines', 300],
            ['animal_9', 'noix, fruits', 180],
            ['animal_10', 'viande rouge', 1200],
            ['animal_11', 'lapins, rongeurs', 400],
            ['animal_12', 'herbes alpines', 600],
            ['animal_13', 'feuilles, lichens', 500],
            ['animal_14', 'viande de boeuf', 800],
            ['animal_15', 'racines, graines', 300],
            ['animal_16', 'branches, écorce', 300],
            ['animal_17', 'poulet, boeuf', 1100],
            ['animal_18', 'herbe, foin', 950],
            ['animal_19', 'légumes aquatiques', 700],
            ['animal_20', 'fruits, vers de terre', 180],
            ['animal_21', 'branches, herbes', 200],
            ['animal_22', 'feuilles d’acacia', 50],
            ['animal_23', 'branches tendres', 30],
            ['animal_24', 'agneau, poulet', 40],
            ['animal_25', 'boeuf, poisson', 60],
            ['animal_26', 'foin, herbes', 140],
            ['animal_27', 'herbes, écorce', 50],
        ];

        $ajoutePar = $this->getReference('user_veterinaire_3');

        foreach ($repasData as [$animalRef, $nourriture, $quantite]) {
            $repas = new Repas();
            $repas->setAnimal($this->getReference($animalRef));
            $repas->setAjoutePar($ajoutePar);
            $repas->setDateHeure(new DateTime());
            $repas->setNourritureDonnee($nourriture);
            $repas->setQuantite($quantite);

            $manager->persist($repas);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AnimalFixtures::class,
            UserFixtures::class,
        ];
    }
}
