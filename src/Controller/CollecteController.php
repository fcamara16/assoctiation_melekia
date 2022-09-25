<?php

namespace App\Controller;

use App\Entity\Collecte;
use App\Form\CollecteType;
use App\Repository\CollecteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/collecte")
 */
class CollecteController extends AbstractController
{
    /**
     * @Route("/", name="app_collecte_index", methods={"GET"})
     */
    public function index(CollecteRepository $collecteRepository): Response
    {
        return $this->render('collecte/index.html.twig', [
            'collectes' => $collecteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_collecte_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CollecteRepository $collecteRepository): Response
    {
        $collecte = new Collecte();
        $form = $this->createForm(CollecteType::class, $collecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $collecteRepository->add($collecte);
            return $this->redirectToRoute('app_collecte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collecte/new.html.twig', [
            'collecte' => $collecte,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_collecte_show", methods={"GET"})
     */
    public function show(Collecte $collecte): Response
    {
        return $this->render('collecte/show.html.twig', [
            'collecte' => $collecte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_collecte_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Collecte $collecte, CollecteRepository $collecteRepository): Response
    {
        $form = $this->createForm(CollecteType::class, $collecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collecteRepository->add($collecte);
            return $this->redirectToRoute('app_collecte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collecte/edit.html.twig', [
            'collecte' => $collecte,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_collecte_delete", methods={"POST"})
     */
    public function delete(Request $request, Collecte $collecte, CollecteRepository $collecteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $collecte->getId(), $request->request->get('_token'))) {
            $collecteRepository->remove($collecte);
        }

        return $this->redirectToRoute('app_collecte_index', [], Response::HTTP_SEE_OTHER);
    }
}
