<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Habitat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnimalsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Récupérer les habitats
        $habitatDesert = $manager->getRepository(Habitat::class)->findOneBy(['titre' => 'Désert']);
        $habitatJungle = $manager->getRepository(Habitat::class)->findOneBy(['titre' => 'Jungle']);
        $habitatMontagne = $manager->getRepository(Habitat::class)->findOneBy(['titre' => 'Montagne']);
        $habitatMarais = $manager->getRepository(Habitat::class)->findOneBy(['titre' => 'Marais']);
        $habitatSavane = $manager->getRepository(Habitat::class)->findOneBy(['titre' => 'Savane']);

        // Liste des animaux à ajouter
        $animals = [
            ['Nick', 'Vipère des sables', $habitatDesert, 'En bonne santé', 'petits mammifères, oiseaux, lézards', 1, '2024-09-11 23:03:00'],
            ['Feunard', 'Fennec', $habitatDesert, 'Un peu fatigué', 'petits rongeurs, insectes, fruits', 1, '2024-09-12 06:18:00'],
            ['Abo', 'Cobra royal', $habitatDesert, 'Actif', 'petits mammifères, oiseaux, reptiles', 1, '2024-09-03 02:00:00'],
            ['Doma', 'Dromadaire', $habitatDesert, 'Fatigué', 'herbes, feuilles, graines', 500, '2024-09-01 03:00:00'],
            ['Zed', 'Iguane du désert', $habitatDesert, 'En bonne santé', 'végétation désertique, insectes', 200, '2024-09-24 05:06:00'],
            ['Killer', 'Anaconda', $habitatJungle, 'Bonne santé', 'petits mammifères, oiseaux, poissons', 800, '2024-09-03 02:05:00'],
            ['Garry', 'Jaguar', $habitatJungle, 'Bonne santé', 'mammifères de taille moyenne, poissons, oiseaux', 1000, '2024-09-04 00:00:00'],
            ['Kaki', 'Macaque', $habitatJungle, 'Bonne santé', 'fruits, graines, insectes', 300, '2024-09-05 00:00:00'],
            ['Spin', 'Perroquet Ara Rouge', $habitatJungle, 'Bonne santé', 'fruits, graines, noix', 200, '2024-09-06 00:00:00'],
            ['Rex', 'Tigre du Bengale', $habitatJungle, 'Bonne santé', 'cervidés, sangliers, buffles', 1200, '2024-09-07 00:00:00'],
            ['Scott', 'Aigle royal', $habitatMontagne, 'En bonne santé', 'petits mammifères, oiseaux, reptiles', 500, '2024-09-01 03:00:00'],
            ['Cricri', 'Bouquetin', $habitatMontagne, 'En bonne santé', 'herbes alpines, lichens, petits arbustes', 600, '2024-09-02 00:00:00'],
            ['Doug', 'Chamois', $habitatMontagne, 'En bonne santé', 'herbes alpines, lichens, petits arbustes', 550, '2024-09-03 00:00:00'],
            ['Wolf', 'Loup gris', $habitatMontagne, 'En bonne santé', 'viande de bœuf, poulet, poisson', 700, '2024-09-04 00:00:00'],
            ['Spog', 'Marmotte', $habitatMontagne, 'En bonne santé', 'herbes, racines, baies', 300, '2024-09-05 00:00:00'],
            ['Crac', 'Castor', $habitatMarais, 'En bonne santé', 'écorce, branches, plantes aquatiques', 350, '2024-09-06 04:05:00'],
            ['Godzilla', 'Crocodile du Nil', $habitatMarais, 'En bonne santé', 'viande de poulet, poisson, bœuf', 1200, '2024-09-07 00:00:00'],
            ['Pumba', 'Hippopotame', $habitatMarais, 'En bonne santé', 'foin, herbe, légumes', 1000, '2024-09-08 00:00:00'],
            ['Annie', 'Lamantin', $habitatMarais, 'En bonne santé', 'laitue, algues, légumes aquatiques', 900, '2024-09-09 02:04:00'],
            ['Shelly', 'Tortue de Californie', $habitatMarais, 'En bonne santé', 'végétaux, fruits, vers de terre', 200, '2024-09-10 00:00:00'],
            ['Tembo', 'Éléphant d\'Afrique', $habitatSavane, 'En bonne santé', 'herbes, feuilles, écorce', 200, '2024-09-01 00:00:00'],
            ['Jasiri', 'Girafe', $habitatSavane, 'Un peu fatiguée', 'feuilles d\'acacia, branches', 50, '2024-09-02 00:00:00'],
            ['Kito', 'Girafe (Jeune)', $habitatSavane, 'Actif', 'feuilles d\'acacia, branches', 30, '2024-09-03 00:00:00'],
            ['Raja', 'Guépard', $habitatSavane, 'En forme', 'viande de poulet, agneau, mouton', 20, '2024-09-04 00:00:00'],
            ['Simba', 'Lion', $habitatSavane, 'Repos', 'viande de bœuf, poulet, poisson', 40, '2024-09-05 00:00:00'],
            ['RhinoFamily', 'Rhinocéros', $habitatSavane, 'Actif', 'foin, herbes, branches', 150, '2024-09-06 00:00:00'],
            ['Zuri', 'Zèbre', $habitatSavane, 'En bonne santé', 'herbes, feuilles, écorce', 60, '2024-09-07 00:00:00'],
        ];

        // Créer et persister les animaux
        foreach ($animals as $animalData) {
            $animal = new Animal();
            $animal->setPrenom($animalData[0]);
            $animal->setRace($animalData[1]);
            $animal->setHabitat($animalData[2]);
            $animal->setEtatAnimal($animalData[3]);
            $animal->setNourritureProposee($animalData[4]);
            $animal->setGrammageNourriture($animalData[5]);
            $animal->setDatePassage(new \DateTime($animalData[6]));
            
            // Persister l'animal
            $manager->persist($animal);
        }

        // Sauvegarder dans la base de données
        $manager->flush();
    }
}
