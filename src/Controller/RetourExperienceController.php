<?php

namespace App\Controller;

use App\Entity\Defi;
use App\Repository\RetourExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
