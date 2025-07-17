<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // ADMIN
        $admin = new User();
        $admin->setEmail('admin@zoo.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'admin123')
        );
        $admin->setPrenom('Jose');
        $admin->setNom('Dupont');
        $admin->setDateCreation(new \DateTime());
        $manager->persist($admin);
        $this->addReference('user-admin', $admin);

        // EMPLOYÉ
        $employe = new User();
        $employe->setEmail('employe@zoo.com');
        $employe->setRoles(['ROLE_EMPLOYE']);
        $employe->setPassword(
            $this->passwordHasher->hashPassword($employe, 'employe123')
        );
        $employe->setPrenom('Pierre');
        $employe->setNom('Delaitre');
        $employe->setDateCreation(new \DateTime('-2 days'));
        $manager->persist($employe);
        $this->addReference('user-employe', $employe);

        // VÉTÉRINAIRE
        $veto = new User();
        $veto->setEmail('veterinaire@zoo.com');
        $veto->setRoles(['ROLE_VETERINAIRE']);
        $veto->setPassword(
            $this->passwordHasher->hashPassword($veto, 'veterinaire123')
        );
        $veto->setPrenom('Alice');
        $veto->setNom('Berthe');
        $veto->setDateCreation(new \DateTime('-1 week'));
        $manager->persist($veto);
        $this->addReference('user-veterinaire', $veto);

        $manager->flush();
    }
}
