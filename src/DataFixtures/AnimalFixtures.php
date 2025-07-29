<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $animals = [
            ['Nick', 'Vipère des sables', 'habitat_desert', 'En bonne santé', 'petits mammifères, oiseaux, lézards', 1, '2024-09-11 23:03:00'],
            ['Feunard', 'Fennec', 'habitat_desert', 'Un peu fatigué', 'petits rongeurs, insectes, fruits', 1, '2024-09-12 06:18:00'],
            ['Abo', 'Cobra royal', 'habitat_desert', 'Actif', 'petits mammifères, oiseaux, reptiles', 1, '2024-09-03 02:00:00'],
            ['Doma', 'Dromadaire', 'habitat_desert', 'Fatigué', 'herbes, feuilles, graines', 500, '2024-09-01 03:00:00'],
            ['Zed', 'Iguane du désert', 'habitat_desert', 'En bonne santé', 'végétation désertique, insectes', 200, '2024-09-24 05:06:00'],
            ['Killer', 'Anaconda', 'habitat_jungle', 'Bonne santé', 'petits mammifères, oiseaux, poissons', 800, '2024-09-03 02:05:00'],
            ['Garry', 'Jaguar', 'habitat_jungle', 'Bonne santé', 'mammifères de taille moyenne, poissons, oiseaux', 1000, '2024-09-04 00:00:00'],
            ['Kaki', 'Macaque', 'habitat_jungle', 'Bonne santé', 'fruits, graines, insectes', 300, '2024-09-05 00:00:00'],
            ['Spin', 'Perroquet Ara Rouge', 'habitat_jungle', 'Bonne santé', 'fruits, graines, noix', 200, '2024-09-06 00:00:00'],
            ['Rex', 'Tigre du Bengale', 'habitat_jungle', 'Bonne santé', 'cervidés, sangliers, buffles', 1200, '2024-09-07 00:00:00'],
            ['Scott', 'Aigle royal', 'habitat_montagne', 'En bonne santé', 'petits mammifères, oiseaux, reptiles', 500, '2024-09-01 03:00:00'],
            ['Cricri', 'Bouquetin', 'habitat_montagne', 'En bonne santé', 'herbes alpines, lichens, petits arbustes', 600, '2024-09-02 00:00:00'],
            ['Doug', 'Chamois', 'habitat_montagne', 'En bonne santé', 'herbes alpines, lichens, petits arbustes', 550, '2024-09-03 00:00:00'],
            ['Wolf', 'Loup gris', 'habitat_montagne', 'En bonne santé', 'viande de bœuf, poulet, poisson', 700, '2024-09-04 00:00:00'],
            ['Spog', 'Marmotte', 'habitat_montagne', 'En bonne santé', 'herbes, racines, baies', 300, '2024-09-05 00:00:00'],
            ['Crac', 'Castor', 'habitat_marais', 'En bonne santé', 'écorce, branches, plantes aquatiques', 350, '2024-09-06 04:05:00'],
            ['Godzilla', 'Crocodile du Nil', 'habitat_marais', 'En bonne santé', 'viande de poulet, poisson, bœuf', 1200, '2024-09-07 00:00:00'],
            ['Pumba', 'Hippopotame', 'habitat_marais', 'En bonne santé', 'foin, herbe, légumes', 1000, '2024-09-08 00:00:00'],
            ['Annie', 'Lamantin', 'habitat_marais', 'En bonne santé', 'laitue, algues, légumes aquatiques', 900, '2024-09-09 02:04:00'],
            ['Shelly', 'Tortue de Californie', 'habitat_marais', 'En bonne santé', 'végétaux, fruits, vers de terre', 200, '2024-09-10 00:00:00'],
            ['Tembo', 'Éléphant d\'Afrique', 'habitat_savane', 'En bonne santé', 'herbes, feuilles, écorce', 200, '2024-09-01 00:00:00'],
            ['Jasiri', 'Girafe', 'habitat_savane', 'Un peu fatiguée', 'feuilles d\'acacia, branches', 50, '2024-09-02 00:00:00'],
            ['Kito', 'Girafe (Jeune)', 'habitat_savane', 'Actif', 'feuilles d\'acacia, branches', 30, '2024-09-03 00:00:00'],
            ['Raja', 'Guépard', 'habitat_savane', 'En forme', 'viande de poulet, agneau, mouton', 20, '2024-09-04 00:00:00'],
            ['Simba', 'Lion', 'habitat_savane', 'Repos', 'viande de bœuf, poulet, poisson', 40, '2024-09-05 00:00:00'],
            ['RhinoFamily', 'Rhinocéros', 'habitat_savane', 'Actif', 'foin, herbes, branches', 150, '2024-09-06 00:00:00'],
            ['Zuri', 'Zèbre', 'habitat_savane', 'En bonne santé', 'herbes, feuilles, écorce', 60, '2024-09-07 00:00:00'],
        ];

        foreach ($animals as $index => [$prenom, $race, $habitatRef, $etat, $nourriture, $grammage, $date]) {
            $animal = new Animal();
            $animal->setPrenom($prenom);
            $animal->setRace($race);
            $animal->setHabitat($this->getReference($habitatRef));
            $animal->setEtat($etat);
            $animal->setNourritureProposee($nourriture);
            $animal->setGrammage($grammage);
            $animal->setDateDernierPassage(new \DateTime($date));
            $manager->persist($animal);

            // Ajout de la référence unique pour chaque animal
            $this->addReference('animal_' . ($index + 1), $animal);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            HabitatFixtures::class,
        ];
    }
}
