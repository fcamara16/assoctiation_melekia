<?php

namespace App\Controller;

use App\Entity\DevenirMembre;
use App\Form\DevenirMembreType;
use App\Repository\DevenirMembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/devenir/membre")
 */
class DevenirMembreController extends AbstractController
{
    /**
     * @Route("/", name="app_devenir_membre_index", methods={"GET"})
     */
    public function index(DevenirMembreRepository $devenirMembreRepository): Response
    {
        return $this->render('devenir_membre/index.html.twig', [
            'devenir_membres' => $devenirMembreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_devenir_membre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DevenirMembreRepository $devenirMembreRepository): Response
    {
        $devenirMembre = new DevenirMembre();
        $form = $this->createForm(DevenirMembreType::class, $devenirMembre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devenirMembreRepository->add($devenirMembre);
            return $this->redirectToRoute('app_devenir_membre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devenir_membre/new.html.twig', [
            'devenir_membre' => $devenirMembre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_devenir_membre_show", methods={"GET"})
     */
    public function show(DevenirMembre $devenirMembre): Response
    {
        return $this->render('devenir_membre/show.html.twig', [
            'devenir_membre' => $devenirMembre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_devenir_membre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DevenirMembre $devenirMembre, DevenirMembreRepository $devenirMembreRepository): Response
    {
        $form = $this->createForm(DevenirMembreType::class, $devenirMembre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devenirMembreRepository->add($devenirMembre);
            return $this->redirectToRoute('app_devenir_membre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devenir_membre/edit.html.twig', [
            'devenir_membre' => $devenirMembre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_devenir_membre_delete", methods={"POST"})
     */
    public function delete(Request $request, DevenirMembre $devenirMembre, DevenirMembreRepository $devenirMembreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devenirMembre->getId(), $request->request->get('_token'))) {
            $devenirMembreRepository->remove($devenirMembre);
        }

        return $this->redirectToRoute('app_devenir_membre_index', [], Response::HTTP_SEE_OTHER);
    }
}
