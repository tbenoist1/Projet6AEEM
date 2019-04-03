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

    //-------------------------------Accueil------------------------------// 
    
    /**
     * @Route("/", name="GestionProfesseurs")
     */
    public function gestionProfesseurs()
    {
        return $this->render('professeur/GestionProfesseurs.html.twig');
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




    //-------------------------------Supprimer------------------------------//

    /**
     * @Route("/supprimerProfesseur", name="SupprimerProfesseur", methods={"GET"})
     */
    public function supprimerProfesseur(ProfesseurRepository $professeurRepository): Response
     {
         return $this->render('professeur/SupprimerProfesseur.html.twig', [
             'professeurs' => $professeurRepository->findAll(),
         ]);
     }

    /**
     * @Route("/supprimerProfesseur/{id}", name="SupprimerProfesseurId", methods={"DELETE"})
     */
    public function supprimerProfesseurId(Request $request, Professeur $professeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($professeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('SupprimerProfesseur');
    }




    //-------------------------------Consuter------------------------------//

    /**
     * @Route("/consulterProfesseur", name="ConsulterProfesseur", methods={"GET"})
     */
    public function consulterProfesseur(ProfesseurRepository $professeurRepository): Response
     {
         return $this->render('professeur/ConsulterProfesseur.html.twig', [
             'professeurs' => $professeurRepository->findAll(),
         ]);
     }

    /**
     * @Route("/consulterProfesseur/{id}", name="ConsulterProfesseurId", methods={"GET"})
     */
    public function consulterProfesseurId(Professeur $professeur, Request $request): Response
    {
       $formulaireprofesseur = $this->createForm(ProfesseurType::class, $professeur);

        $formulaireprofesseur->handleRequest($request);
         if ($formulaireprofesseur->isSubmitted() && $formulaireprofesseur->isValid())
         {
            // Enregistrer la ressource en base de donnée
            $manager->persist($professeur);
            $manager->flush();
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('GestionProfesseurs');
         }
        // Afficher la page présentant le formulaire d'ajout d'une professeur
        return $this->render('professeur/ConsulterProfesseurId.html.twig', ['form' => $formulaireprofesseur->createView()]);
    }




    //-------------------------------Modifier------------------------------//

    /**
     * @Route("/modifierProfesseur", name="ModifierProfesseur", methods={"GET"})
     */
    public function modifierProfesseur(ProfesseurRepository $professeurRepository): Response
    {
        return $this->render('professeur/ModifierProfesseur.html.twig', [
            'professeurs' => $professeurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/modifierProfesseur/{id}", name="ModifierProfesseurId", methods={"GET","POST"})
     */
    public function modifierProfesseurId(Request $request, Professeur $professeur): Response
    {
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ModifierProfesseur', [
                'id' => $professeur->getId(),
            ]);
        }

        return $this->render('professeur/ModifierProfesseurId.html.twig', [
            'professeur' => $professeur,
            'form' => $form->createView(),
        ]);
    }

}
