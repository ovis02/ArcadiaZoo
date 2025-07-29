<?php

namespace App\DataFixtures;

use App\Entity\Habitat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HabitatFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $habitat1 = new Habitat();
        $habitat1->setNom('Désert');
        $habitat1->setDescription("Bienvenue dans notre zoo, une oasis de découverte au cœur de la nature sauvage. Explorez notre désert reconstitué, un monde de vastes enclos rocailleux et de ciels infinis. Ici, la vie prospère malgré les défis, avec des créatures extraordinaires adaptées à ce milieu unique. Rencontrez le majestueux cobra royal, le charmant fennec, la redoutable vipère du désert, le gracieux dromadaire et l'insaisissable iguane du désert, chacun illustrant une résilience remarquable dans ce paysage désolé mais magnifique.");
        $habitat1->setImage('desert.jpg');
        $manager->persist($habitat1);
        $this->addReference('habitat_desert', $habitat1);

        $habitat2 = new Habitat();
        $habitat2->setNom('Jungle');
        $habitat2->setDescription("Bienvenue dans la Jungle, un monde d'exploration et de diversité au cœur même de notre zoo. Découvrez l'anaconda, le jaguar, le macaque, le perroquet et le tigre, chacun adapté à ce royaume de végétation dense et de mystère. Plongez dans cet habitat exotique où chaque recoin révèle la beauté et l'ingéniosité de la vie sauvage de la Jungle.");
        $habitat2->setImage('jungle.jpg');
        $manager->persist($habitat2);
        $this->addReference('habitat_jungle', $habitat2);

        $habitat3 = new Habitat();
        $habitat3->setNom('Montagne');
        $habitat3->setDescription("Bienvenue dans les Montagnes, un monde d'altitude et de majesté au cœur même de notre zoo. Découvrez l'aigle royal, le bouquetin, le chamois, le loup et la marmotte, chacun parfaitement adapté à ce royaume de sommets enneigés et de vallées verdoyantes. Plongez dans cet habitat alpin où chaque pic et chaque vallée révèle la beauté et la résilience de la vie sauvage des Montagnes.");
        $habitat3->setImage('montagne.jpg');
        $manager->persist($habitat3);
        $this->addReference('habitat_montagne', $habitat3);

        $habitat4 = new Habitat();
        $habitat4->setNom('Marais');
        $habitat4->setDescription("Bienvenue dans les Marais, un écosystème luxuriant au cœur de notre zoo. Explorez cet habitat humide où le castor, le crocodile du Nil, l'hippopotame, le lamantin et la tortue de Californie prospèrent. Plongez dans ce monde aquatique où chaque créature révèle la beauté de la vie sauvage des Marais.");
        $habitat4->setImage('marais.jpg');
        $manager->persist($habitat4);
        $this->addReference('habitat_marais', $habitat4);

        $habitat5 = new Habitat();
        $habitat5->setNom('Savane');
        $habitat5->setDescription("Bienvenue dans la Savane, un vaste horizon de beauté naturelle au cœur de notre zoo. Découvrez cet habitat emblématique où l'éléphant d'Afrique, la girafe, le guépard, le lion, le rhinocéros et le zèbre évoluent en harmonie. Parcourez ces étendues sauvages où chaque pas révèle la majesté de la vie animale. Plongez dans ce monde fascinant où chaque créature incarne la splendeur de la vie sauvage de la Savane.");
        $habitat5->setImage('savane.jpg');
        $manager->persist($habitat5);
        $this->addReference('habitat_savane', $habitat5);

        $manager->flush();
    }
}
