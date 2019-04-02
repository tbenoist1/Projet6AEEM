<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestionProfesseurs")
 */
class ProfesseurController extends AbstractController
{
    /**
     * @Route("/", name="GestionProfesseurs")
     */
    public function gestionProfesseurs()
    {
        return $this->render('professeur/GestionProfesseurs.html.twig');
    }

    /**
     * @Route("/liste", name="professeur_index", methods={"GET"})
     */
    public function index(ProfesseurRepository $professeurRepository): Response
    {
        return $this->render('professeur/index.html.twig', [
            'professeurs' => $professeurRepository->findAll(),
        ]);
    }

    //-------------------------------Ajouter------------------------------//

    /**
     * @Route("/ajouterProfesseur", name="AjouterProfesseur", methods={"GET","POST"})
     */
    public function ajouterProfesseur(Request $request): Response
    {
        $professeur = new Professeur();
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($professeur);
            $entityManager->flush();

            return $this->redirectToRoute('GestionProfesseurs');
        }

        return $this->render('professeur/AjouterProfesseur.html.twig', [
            'professeur' => $professeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="professeur_show", methods={"GET"})
     */
    public function show(Professeur $professeur): Response
    {
        return $this->render('professeur/show.html.twig', [
            'professeur' => $professeur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="professeur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Professeur $professeur): Response
    {
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('professeur_index', [
                'id' => $professeur->getId(),
            ]);
        }

        return $this->render('professeur/edit.html.twig', [
            'professeur' => $professeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="professeur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Professeur $professeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($professeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('professeur_index');
    }
}
