<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Entity\RetourExperience;
use App\Form\RetourExperienceType;
use App\Repository\RetourExperienceRepository;
use App\Service\ProfilResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RetourExperienceController extends AbstractController
{
    #[Route('/defi/{id}/retours', name: 'app_retour_index', requirements: ['id' => '\d+'])]
    public function index(Defi $defi, RetourExperienceRepository $retourRepo): Response
    {
        $retours = $retourRepo->findBy(['defi' => $defi]);

        return $this->render('retour/index.html.twig', [
            'defi'    => $defi,
            'retours' => $retours,
        ]);
    }

    #[Route('/defi/{id}/retour/nouveau', name: 'app_retour_new', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(
        Defi $defi,
        Request $request,
        EntityManagerInterface $em,
        ProfilResolver $profilResolver
    ): Response {
        $retour = new RetourExperience();
        $retour->setDefi($defi);
        $retour->setDateRetour(new \DateTimeImmutable());

        $form = $this->createForm(RetourExperienceType::class, $retour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if (!$user) {
                throw $this->createAccessDeniedException('Connexion requise.');
            }

            $profil = $profilResolver->resolve($user);
            $retour->setUtilisateur($profil);
            $retour->setDateRetour(new \DateTimeImmutable());

            $em->persist($retour);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre retour d’expérience !');

            return $this->redirectToRoute('app_retour_index', ['id' => $defi->getId()]);
        }

        return $this->render('retour/new.html.twig', [
            'defi' => $defi,
            'form' => $form->createView(),
        ]);
    }
}
