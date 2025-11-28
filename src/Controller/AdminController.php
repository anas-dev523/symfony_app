<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Entity\RetourExperience;
use App\Repository\DefiRepository;
use App\Repository\RetourExperienceRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/admin/defi/{id}/valider', name: 'app_admin_defi_valider', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function validerDefi(Defi $defi, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('valider_defi_'.$defi->getId(), $request->request->get('_token'))) {
            $defi->setStatutModeration('valide');
            $em->flush();
            $this->addFlash('success', sprintf('Le défi "%s" est validé.', $defi->getTitre()));
        }

        return $this->redirectToRoute('app_admin_defis');
    }

    #[Route('/admin/defi/{id}/supprimer', name: 'app_admin_defi_supprimer', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function supprimerDefi(Defi $defi, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('supprimer_defi_'.$defi->getId(), $request->request->get('_token'))) {
            $em->remove($defi);
            $em->flush();
            $this->addFlash('success', 'Défi supprimé.');
        }

        return $this->redirectToRoute('app_admin_defis');
    }

    #[Route('/admin/retour/{id}/supprimer', name: 'app_admin_retour_supprimer', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function supprimerRetour(RetourExperience $retour, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('supprimer_retour_'.$retour->getId(), $request->request->get('_token'))) {
            $em->remove($retour);
            $em->flush();
            $this->addFlash('success', 'Retour supprimé.');
        }

        return $this->redirectToRoute('app_admin_retours');
    }
}
