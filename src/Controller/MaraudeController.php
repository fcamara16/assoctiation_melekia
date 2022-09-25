<?php

namespace App\Controller;

use App\Entity\Maraude;
use App\Form\MaraudeType;
use App\Repository\MaraudeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maraude")
 */
class MaraudeController extends AbstractController
{
    /**
     * @Route("/", name="app_maraude_index", methods={"GET"})
     */
    public function index(MaraudeRepository $maraudeRepository): Response
    {
        return $this->render('maraude/index.html.twig', [
            'maraudes' => $maraudeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_maraude_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MaraudeRepository $maraudeRepository): Response
    {
        $maraude = new Maraude();
        $form = $this->createForm(MaraudeType::class, $maraude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maraudeRepository->add($maraude);
            return $this->redirectToRoute('app_maraude_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maraude/new.html.twig', [
            'maraude' => $maraude,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_maraude_show", methods={"GET"})
     */
    public function show(Maraude $maraude): Response
    {
        return $this->render('maraude/show.html.twig', [
            'maraude' => $maraude,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_maraude_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Maraude $maraude, MaraudeRepository $maraudeRepository): Response
    {
        $form = $this->createForm(MaraudeType::class, $maraude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maraudeRepository->add($maraude);
            return $this->redirectToRoute('app_maraude_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maraude/edit.html.twig', [
            'maraude' => $maraude,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_maraude_delete", methods={"POST"})
     */
    public function delete(Request $request, Maraude $maraude, MaraudeRepository $maraudeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maraude->getId(), $request->request->get('_token'))) {
            $maraudeRepository->remove($maraude);
        }

        return $this->redirectToRoute('app_maraude_index', [], Response::HTTP_SEE_OTHER);
    }
}
