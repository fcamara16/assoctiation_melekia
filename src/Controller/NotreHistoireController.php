<?php

namespace App\Controller;

use App\Entity\NotreHistoire;
use App\Form\NotreHistoireType;
use App\Repository\NotreHistoireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/notre/histoire")
 */
class NotreHistoireController extends AbstractController
{
    /**
     * @Route("/", name="app_notre_histoire_index", methods={"GET"})
     */
    public function index(NotreHistoireRepository $notreHistoireRepository): Response
    {
        return $this->render('notre_histoire/index.html.twig', [
            'notre_histoires' => $notreHistoireRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="app_notre_histoire_new", methods={"GET", "POST"})
     */
    public function new(Request $request, NotreHistoireRepository $notreHistoireRepository): Response
    {
        $notreHistoire = new NotreHistoire();
        $form = $this->createForm(NotreHistoireType::class, $notreHistoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Variabilisation du fichier 'photo' uploadé.
            /** @var UploadedFile $file */
            $file = $form->get('images')->getData();

            // if (isset($file) === true)
            // Si un fichier est uploadé (depuis le formulaire)
            if ($file) {
                // Maintenant il s'agit de reconstruire le nom du fichier pour le sécuriser.

                // 1ère ÉTAPE : on déconstruit le nom du fichier et on variabilise.
                $extension = '.' . $file->guessExtension();
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                // Assainissement du nom de fichier (du filename)
                //                $safeFilename = $slugger->slug($originalFilename);


                // 2ème ÉTAPE : on reconstruit le nom du fichier maintenant qu'il est safe.
                // uniqid() est une fonction native de PHP, elle permet d'ajouter une valeur numérique (id) unique et auto-générée.
                $newFilename =  uniqid() . $extension;

                // try/catch fait partie de PHP nativement.
                try {

                    // On a configuré un paramètre 'uploads_dir' dans le fichier services.yaml
                    // Ce param contient le chemin absolu de notre dossier d'upload de photo.
                    $file->move($this->getParameter('uploads_dir'), $newFilename);

                    // On set le NOM de la photo, pas le CHEMIN
                    $notreHistoire->setImages($newFilename);
                } catch (FileException $exception) {
                } // END catch()
            } // END if($file)
            $notreHistoireRepository->add($notreHistoire);
            return $this->redirectToRoute('app_notre_histoire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('notre_histoire/new.html.twig', [
            'notre_histoire' => $notreHistoire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_notre_histoire_show", methods={"GET"})
     */
    public function show(NotreHistoire $notreHistoire): Response
    {
        return $this->render('notre_histoire/show.html.twig', [
            'notre_histoire' => $notreHistoire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_notre_histoire_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, NotreHistoire $notreHistoire, NotreHistoireRepository $notreHistoireRepository): Response
    {
        $form = $this->createForm(NotreHistoireType::class, $notreHistoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notreHistoireRepository->add($notreHistoire);
            return $this->redirectToRoute('app_notre_histoire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('notre_histoire/edit.html.twig', [
            'notre_histoire' => $notreHistoire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_notre_histoire_delete", methods={"POST"})
     */
    public function delete(Request $request, NotreHistoire $notreHistoire, NotreHistoireRepository $notreHistoireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $notreHistoire->getId(), $request->request->get('_token'))) {
            $notreHistoireRepository->remove($notreHistoire);
        }

        return $this->redirectToRoute('app_notre_histoire_index', [], Response::HTTP_SEE_OTHER);
    }
}
