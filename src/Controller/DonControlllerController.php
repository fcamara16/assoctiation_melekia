<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DonControlllerController extends AbstractController
{
    /**
     * @Route("/faire_un_don", name="app_don_controlller")
     */
    public function index(): Response
    {
        return $this->render('don_controlller/index.html.twig', [
            'controller_name' => 'DonControlllerController',
        ]);
    }
}
