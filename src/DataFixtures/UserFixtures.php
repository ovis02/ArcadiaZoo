<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Liste des utilisateurs à créer
        $users = [
            [
                'email' => 'jose@example.com',
                'roles' => ['ROLE_ADMIN'],
                'password' => 'admin123',
            ],
            [
                'email' => 'joelle@example.com',
                'roles' => ['ROLE_VETERINARIAN'],
                'password' => 'vet123',
            ],
            [
                'email' => 'pierre@example.com',
                'roles' => ['ROLE_EMPLOYEE'],
                'password' => 'employee123',
            ],
        ];

        // Création et persistance des utilisateurs
        foreach ($users as $userData) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setRoles($userData['roles']);
            $hashedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }

        // Enregistrer les utilisateurs dans la base de données
        $manager->flush();
    }
}

