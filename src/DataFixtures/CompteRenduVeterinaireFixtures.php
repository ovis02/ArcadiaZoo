<?php

namespace App\DataFixtures;

use App\Entity\CompteRenduVeterinaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CompteRenduVeterinaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['animal_ref' => 'animal_1', 'etat' => 'En bonne santé', 'nourriture' => 'petits mammifères, oiseaux, lézards', 'grammage' => 1, 'date' => '2024-09-11 23:03:00'],
            ['animal_ref' => 'animal_2', 'etat' => 'Un peu fatigué', 'nourriture' => 'petits rongeurs, insectes, fruits', 'grammage' => 1, 'date' => '2024-09-12 06:18:00'],
            ['animal_ref' => 'animal_3', 'etat' => 'Actif', 'nourriture' => 'petits mammifères, oiseaux, reptiles', 'grammage' => 1, 'date' => '2024-09-03 02:00:00'],
            ['animal_ref' => 'animal_4', 'etat' => 'Fatigué', 'nourriture' => 'herbes, feuilles, graines', 'grammage' => 500, 'date' => '2024-09-01 03:00:00'],
            ['animal_ref' => 'animal_5', 'etat' => 'En bonne santé', 'nourriture' => 'végétation désertique, insectes', 'grammage' => 200, 'date' => '2024-09-24 05:06:00'],
            ['animal_ref' => 'animal_6', 'etat' => 'Bonne santé', 'nourriture' => 'petits mammifères, oiseaux, poissons', 'grammage' => 800, 'date' => '2024-09-03 02:05:00'],
            ['animal_ref' => 'animal_7', 'etat' => 'Bonne santé', 'nourriture' => 'mammifères de taille moyenne, poissons, oiseaux', 'grammage' => 1000, 'date' => '2024-09-04 00:00:00'],
            ['animal_ref' => 'animal_8', 'etat' => 'Bonne santé', 'nourriture' => 'fruits, graines, insectes', 'grammage' => 300, 'date' => '2024-09-05 00:00:00'],
            ['animal_ref' => 'animal_9', 'etat' => 'Bonne santé', 'nourriture' => 'fruits, graines, noix', 'grammage' => 200, 'date' => '2024-09-06 00:00:00'],
            ['animal_ref' => 'animal_10', 'etat' => 'Bonne santé', 'nourriture' => 'cervidés, sangliers, buffles', 'grammage' => 1200, 'date' => '2024-09-07 00:00:00'],
            ['animal_ref' => 'animal_11', 'etat' => 'En bonne santé', 'nourriture' => 'petits mammifères, oiseaux, reptiles', 'grammage' => 500, 'date' => '2024-09-01 03:00:00'],
            ['animal_ref' => 'animal_12', 'etat' => 'En bonne santé', 'nourriture' => 'herbes alpines, lichens, petits arbustes', 'grammage' => 600, 'date' => '2024-09-02 00:00:00'],
            ['animal_ref' => 'animal_13', 'etat' => 'En bonne santé', 'nourriture' => 'herbes alpines, lichens, petits arbustes', 'grammage' => 550, 'date' => '2024-09-03 00:00:00'],
            ['animal_ref' => 'animal_14', 'etat' => 'En bonne santé', 'nourriture' => 'viande de bœuf, poulet, poisson', 'grammage' => 700, 'date' => '2024-09-04 00:00:00'],
            ['animal_ref' => 'animal_15', 'etat' => 'En bonne santé', 'nourriture' => 'herbes, racines, baies', 'grammage' => 300, 'date' => '2024-09-05 00:00:00'],
            ['animal_ref' => 'animal_16', 'etat' => 'En bonne santé', 'nourriture' => 'écorce, branches, plantes aquatiques', 'grammage' => 350, 'date' => '2024-09-06 04:05:00'],
            ['animal_ref' => 'animal_17', 'etat' => 'En bonne santé', 'nourriture' => 'viande de poulet, poisson, bœuf', 'grammage' => 1200, 'date' => '2024-09-07 00:00:00'],
            ['animal_ref' => 'animal_18', 'etat' => 'En bonne santé', 'nourriture' => 'foin, herbe, légumes', 'grammage' => 1000, 'date' => '2024-09-08 00:00:00'],
            ['animal_ref' => 'animal_19', 'etat' => 'En bonne santé', 'nourriture' => 'laitue, algues, légumes aquatiques', 'grammage' => 900, 'date' => '2024-09-09 02:04:00'],
            ['animal_ref' => 'animal_20', 'etat' => 'En bonne santé', 'nourriture' => 'végétaux, fruits, vers de terre', 'grammage' => 200, 'date' => '2024-09-10 00:00:00'],
            ['animal_ref' => 'animal_21', 'etat' => 'En bonne santé', 'nourriture' => 'herbes, feuilles, écorce', 'grammage' => 200, 'date' => '2024-09-01 00:00:00'],
            ['animal_ref' => 'animal_22', 'etat' => 'Un peu fatiguée', 'nourriture' => 'feuilles d\'acacia, branches', 'grammage' => 50, 'date' => '2024-09-02 00:00:00'],
            ['animal_ref' => 'animal_23', 'etat' => 'Actif', 'nourriture' => 'feuilles d\'acacia, branches', 'grammage' => 30, 'date' => '2024-09-03 00:00:00'],
            ['animal_ref' => 'animal_24', 'etat' => 'En forme', 'nourriture' => 'viande de poulet, agneau, mouton', 'grammage' => 20, 'date' => '2024-09-04 00:00:00'],
            ['animal_ref' => 'animal_25', 'etat' => 'Repos', 'nourriture' => 'viande de bœuf, poulet, poisson', 'grammage' => 40, 'date' => '2024-09-05 00:00:00'],
            ['animal_ref' => 'animal_26', 'etat' => 'Actif', 'nourriture' => 'foin, herbes, branches', 'grammage' => 150, 'date' => '2024-09-06 00:00:00'],
            ['animal_ref' => 'animal_27', 'etat' => 'En bonne santé', 'nourriture' => 'herbes, feuilles, écorce', 'grammage' => 60, 'date' => '2024-09-07 00:00:00'],
        ];

        $veterinaire = $this->getReference('user_veterinaire_3');

        foreach ($data as $entry) {
            $compteRendu = new CompteRenduVeterinaire();
            $compteRendu->setEtat($entry['etat']);
            $compteRendu->setNourriture($entry['nourriture']);
            $compteRendu->setGrammage($entry['grammage']);
            $compteRendu->setDate(new \DateTime($entry['date']));
            $compteRendu->setCommentaire(null); // Optionnel
            $compteRendu->setAnimal($this->getReference($entry['animal_ref']));
            $compteRendu->setVeterinaire($veterinaire);

            $manager->persist($compteRendu);
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
