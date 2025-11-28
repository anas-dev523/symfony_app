<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Entity\DemandeAide;
use App\Form\DemandeAideType;
use App\Service\ProfilResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DemandeAideController extends AbstractController
{
    #[Route('/defi/{id}/aide/nouvelle', name: 'app_demande_aide_new', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(
        Defi $defi,
        Request $request,
        EntityManagerInterface $em,
        ProfilResolver $profilResolver
    ): Response {
        $demande = new DemandeAide();
        $demande->setDefi($defi);

        $form = $this->createForm(DemandeAideType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if (!$user) {
                throw $this->createAccessDeniedException();
            }

            $profil = $profilResolver->resolve($user);
            $demande->setUtilisateur($profil);
            $demande->setDateDemande(new \DateTimeImmutable());
            $demande->setStatut('ouverte');

            $em->persist($demande);
            $em->flush();

            $this->addFlash('success', 'Votre demande d’aide a bien été envoyée.');

            return $this->redirectToRoute('app_retour_index', ['id' => $defi->getId()]);
        }

        return $this->render('demande_aide/new.html.twig', [
            'defi' => $defi,
            'form' => $form->createView(),
        ]);
    }
}

