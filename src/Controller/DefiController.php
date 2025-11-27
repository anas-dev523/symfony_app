<?php

namespace App\Controller;

use App\Repository\DefiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefiController extends AbstractController
{
    // Page d'accueil : affiche un défi aléatoire pour le visiteur
    #[Route('/', name: 'app_home')]
    public function home(DefiRepository $defiRepository): Response
    {
        $defis = $defiRepository->findAll();

        $defi = null;
        if (!empty($defis)) {
            $defi = $defis[array_rand($defis)];
        }

        return $this->render('defi/home.html.twig', [
            'defi' => $defi,
        ]);
    }

    // Liste de tous les défis (lecture simple)
    #[Route('/defis', name: 'app_defi_index')]
    public function index(DefiRepository $defiRepository): Response
    {
        $defis = $defiRepository->findAll();

        return $this->render('defi/index.html.twig', [
            'defis' => $defis,
        ]);
    }

    // API : retourne un défi aléatoire au format JSON
    #[Route('/api/defi/aleatoire', name: 'api_defi_aleatoire', methods: ['GET'])]
    public function apiAleatoire(DefiRepository $defiRepository): Response
    {
        $defis = $defiRepository->findAll();

        if (empty($defis)) {
            return $this->json(['message' => 'Aucun défi en base'], 404);
        }

        $defi = $defis[array_rand($defis)];

        return $this->json([
            'id'          => $defi->getId(),
            'titre'       => $defi->getTitre(),
            'description' => $defi->getDescription(),
            'difficulte'  => $defi->getDifficulte(),
            'duree'       => $defi->getDuree(),
        ]);
    }
}
