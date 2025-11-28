<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $adminUser = new User();
        $adminUser->setEmail('admin@demo.com');
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setPassword($this->passwordHasher->hashPassword($adminUser, 'admin123'));
        $manager->persist($adminUser);

        $adminProfil = new Utilisateur();
        $adminProfil->setNom('Admin');
        $adminProfil->setPrenom('Demo');
        $adminProfil->setEmail($adminUser->getUserIdentifier());
        $adminProfil->setAffichagePublic(true);
        $manager->persist($adminProfil);

        $user = new User();
        $user->setEmail('user@demo.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'user123'));
        $manager->persist($user);

        $userProfil = new Utilisateur();
        $userProfil->setNom('Utilisateur');
        $userProfil->setPrenom('Demo');
        $userProfil->setEmail($user->getUserIdentifier());
        $userProfil->setAffichagePublic(true);
        $manager->persist($userProfil);

        $manager->flush();
    }
}
