<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $services = [
            [
                'nom' => 'Billetterie',
                'description' => "Que vous veniez en famille, entre amis ou en solo, nous sommes prêts à vous accueillir pour une journée mémorable parmi les merveilles de la nature. Nos tarifs sont simples et accessibles à tous : l'entrée est gratuite pour les explorateurs de moins de 4 ans, 10 euros pour les enfants de 4 à 11 ans, et 15 euros pour les visiteurs de 11 ans et plus. Achetez vos billets directement sur place et préparez-vous à vivre des aventures inoubliables au zoo !",
                'image' => 'billet.jpg',
            ],
            [
                'nom' => 'Accès & Horaires',
                'description' => "Arcadia est idéalement situé près de la forêt de Brocéliande, en Bretagne. Pour nous rejoindre, vous pouvez utiliser plusieurs moyens de transport :\n\nVoiture : Notre adresse pour GPS est la suivante Arcadia, Forêt de Brocéliande, 35XXX, Bretagne. Des panneaux de signalisation vous guideront depuis les routes principales jusqu'à notre zoo.\n\nTransport en commun : Des lignes de bus desservent la zone à proximité du zoo.\n\nNous sommes ouverts tous les jours de la semaine, sauf le lundi.\nMardi au vendredi : 9h00 - 18h00\nSamedi et dimanche : 10h00 - 19h00",
                'image' => 'zoo.jpg',
            ],
            [
                'nom' => 'Le petit train',
                'description' => "Préparez-vous à une visite panoramique relaxante à travers notre parc zoologique. Que vous soyez jeune ou jeune de cœur, notre petit train est prêt à vous emmener pour une aventure inoubliable. Montez à bord et laissez-vous guider à travers les merveilles de la nature, tout en profitant d'une vue imprenable sur nos habitats et nos habitants. Le voyage est inclus dans votre billet d'entrée, alors ne manquez pas cette occasion de découvrir le zoo d'une toute nouvelle perspective.",
                'image' => 'minitrain.jpg',
            ],
            [
                'nom' => 'Guide',
                'description' => "Profitez de l'opportunité de découvrir notre zoo aux côtés de nos guides expérimentés et passionnés. Nos visites guidées sont un excellent moyen d'en apprendre davantage sur nos habitants à fourrure et à plumes, ainsi que sur les efforts de conservation que nous menons. Que vous soyez intéressé par les faits fascinants sur nos animaux, les anecdotes sur leur comportement ou les défis auxquels ils sont confrontés dans la nature, nos guides sont là pour répondre à toutes vos questions.",
                'image' => 'guide.jpg',
            ],
            [
                'nom' => 'Restauration',
                'description' => "Détendez-vous et régalez-vous avec notre sélection savoureuse de burgers, paninis et bien plus encore. Notre restaurant vous propose une expérience culinaire exceptionnelle, où chaque plat est préparé avec soin et fraîcheur. Que vous soyez amateur de viande juteuse, de fromage fondant ou de légumes croquants, nous avons quelque chose pour satisfaire toutes les papilles.",
                'image' => 'restaurant.jpg',
            ],
        ];

        foreach ($services as $data) {
            $service = new Service();
            $service->setNom($data['nom']);
            $service->setDescription($data['description']);
            $service->setImage($data['image']);
            $manager->persist($service);
        }

        $manager->flush();
    }
}

