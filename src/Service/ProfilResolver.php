<?php

namespace App\Service;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfilResolver
{
    public function __construct(
        private readonly UtilisateurRepository $utilisateurRepository,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function resolve(UserInterface $user): Utilisateur
    {
        $profil = $this->utilisateurRepository->findOneBy([
            'email' => $user->getUserIdentifier(),
        ]);

        if ($profil) {
            return $profil;
        }

        $profil = new Utilisateur();
        $profil->setEmail($user->getUserIdentifier());
        $profil->setNom('Utilisateur');
        $profil->setPrenom('Connecté');
        $profil->setAffichagePublic(true);

        $this->entityManager->persist($profil);
        $this->entityManager->flush();

        return $profil;
    }
}

