<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $contacts = [
            ['emma.dupuis@email.com', 'Horaires d\'ouverture', 'Bonjour, pouvez-vous me confirmer les horaires du dimanche ?', 'en attente', null, '-6 days'],
            ['yassine.ben@email.com', 'Tarifs', 'Les tarifs sont-ils réduits pour les enfants de moins de 3 ans ?', 'traité', 'user_employe_2', '-5 days'],
            ['lola.martin@email.com', 'Accessibilité', 'Le zoo est-il accessible en fauteuil roulant ?', 'traité', 'user_employe_2', '-4 days'],
            ['antoine.rossi@email.com', 'Services', 'Y a-t-il un espace pique-nique ou restauration ?', 'en attente', null, '-3 days'],
            ['amelie.dubois@email.com', 'Réservation', 'Faut-il réserver pour une sortie scolaire ?', 'traité', 'user_employe_2', '-2 days'],
        ];

        foreach ($contacts as [$email, $motif, $message, $status, $traiteParRef, $dateStr]) {
            $contact = new Contact();
            $contact->setEmail($email);
            $contact->setMotif($motif);
            $contact->setMessageContact($message);
            $contact->setStatus($status);
            $contact->setDate(new \DateTime($dateStr));

            if ($traiteParRef) {
                $contact->setTraitePar($this->getReference($traiteParRef));
            }

            $manager->persist($contact);
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
