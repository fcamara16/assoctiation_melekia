<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaliController extends AbstractController
{
    /**
     * @Route("/mali", name="app_mali")
     */
    public function index(): Response
    {
        return $this->render('mali/index.html.twig', [
            'controller_name' => 'MaliController',
        ]);
    }
}
