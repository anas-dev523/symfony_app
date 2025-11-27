<?php

namespace App\Controller;

use App\Repository\DefiRepository;
use App\Repository\RetourExperienceRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_home')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/admin/defis', name: 'app_admin_defis')]
    #[IsGranted('ROLE_ADMIN')]
    public function defis(DefiRepository $defiRepository): Response
    {
        return $this->render('admin/defis.html.twig', [
            'defis' => $defiRepository->findAll(),
        ]);
    }

    #[Route('/admin/retours', name: 'app_admin_retours')]
    #[IsGranted('ROLE_ADMIN')]
    public function retours(RetourExperienceRepository $retourRepo): Response
    {
        return $this->render('admin/retours.html.twig', [
            'retours' => $retourRepo->findAll(),
        ]);
    }

    #[Route('/admin/utilisateurs', name: 'app_admin_utilisateurs')]
    #[IsGranted('ROLE_ADMIN')]
    public function utilisateurs(UtilisateurRepository $userRepo): Response
    {
        return $this->render('admin/utilisateurs.html.twig', [
            'utilisateurs' => $userRepo->findAll(),
        ]);
    }
}
