<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Form\DefiType;
use App\Repository\DefiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DefiController extends AbstractController
{
    // Page d'accueil : affiche un défi aléatoire
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

    // Liste de tous les défis
    #[Route('/defis', name: 'app_defi_index')]
    public function index(DefiRepository $defiRepository): Response
    {
        $defis = $defiRepository->findAll();

        return $this->render('defi/index.html.twig', [
            'defis' => $defis,
        ]);
    }

    // Formulaire création de défi
    #[Route('/defi/nouveau', name: 'app_defi_new')]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $defi = new Defi();

        $form = $this->createForm(DefiType::class, $defi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $defi->setDatePublication(new \DateTimeImmutable());
            $defi->setStatutModeration('en attente');

            $em->persist($defi);
            $em->flush();

            $this->addFlash('success', 'Défi créé avec succès !');

            return $this->redirectToRoute('app_defi_index');
        }

        return $this->render('defi/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // API : défi aléatoire en JSON
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
