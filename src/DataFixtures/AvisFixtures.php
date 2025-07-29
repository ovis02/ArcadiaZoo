<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AvisFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $avisData = [
            ['Léo', 'Super expérience au zoo, mes enfants ont adoré !', true, '-5 days'],
            ['Emma', 'Le personnel est très accueillant, animaux bien traités.', true, '-3 days'],
            ['Karim', 'J’ai trouvé que certaines zones étaient un peu sales.', false, '-2 days'],
            ['Julie', 'Les girafes sont magnifiques, j’ai adoré la savane !', true, '-1 day'],
            ['Nathan', 'Manque de signalisation, j’étais un peu perdu au début.', false, '-7 days'],
        ];

        $validePar = $this->getReference('user_employe_2'); // employé valide les avis

        foreach ($avisData as [$pseudo, $message, $valide, $dateString]) {
            $avis = new Avis();
            $avis->setPseudo($pseudo);
            $avis->setMessage($message);
            $avis->setValide($valide);
            $avis->setDate(new \DateTime($dateString));

            // Seuls les avis validés sont associés à un employé
            if ($valide) {
                $avis->setValidePar($validePar);
            }

            $manager->persist($avis);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
