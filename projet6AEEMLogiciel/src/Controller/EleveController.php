<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestionEleves")
 */
class EleveController extends AbstractController
{

    //-------------------------------Accueil------------------------------// 
    
    /**
     * @Route("/", name="GestionEleves")
     */
    public function gestionEleves()
    {
        return $this->render('eleve/GestionEleves.html.twig');
    }

    /**
     * @Route("/liste", name="eleve_index", methods={"GET"})
     */
    public function index(EleveRepository $eleveRepository): Response
    {
        return $this->render('eleve/index.html.twig', [
            'eleves' => $eleveRepository->findAll(),
        ]);
    }
    

    //-------------------------------Ajouter------------------------------//

    /**
     * @Route("/ajouterEleve", name="AjouterEleve", methods={"GET","POST"})
     */
    public function ajouterEleve(Request $request): Response
    {
        $eleve = new Eleve();
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eleve);
            $entityManager->flush();

            return $this->redirectToRoute('GestionEleves');
        }

        return $this->render('eleve/AjouterEleve.html.twig', [
            'eleve' => $eleve,
            'form' => $form->createView(),
        ]);
    }

    

    //-------------------------------Supprimer------------------------------//

    /**
     * @Route("/{id}", name="SupprimerEleve", methods={"GET"})
     */
    public function supprimerEleve(EleveRepository $eleveRepository): Response
    {
        return $this->render('eleve/SupprimerEleve.html.twig', [
            'eleve' => $eleveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/supprimerEleve/{id}", name="SupprimerEleveId", methods={"DELETE"})
     */
    public function supprimerEleveId(Request $request, Eleve $eleve): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eleve->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eleve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('SupprimerEleve');
    }

    

    //-------------------------------Consuter------------------------------//

    /**
     * @Route("/consulterEleve", name="ConsulterEleve", methods={"GET"})
     */
    public function consulterEleve(EleveRepository $eleveRepository): Response
     {
         return $this->render('eleve/ConsulterEleve.html.twig', [
             'eleves' => $eleveRepository->findAll(),
         ]);
     }

    /**
     * @Route("/consulterEleve/{id}", name="ConsulterEleveId", methods={"GET"})
     */
    public function consulterEleveId(Eleve $eleve, Request $request): Response
    {
       $formulaireEleve = $this->createForm(EleveType::class, $eleve);

        $formulaireEleve->handleRequest($request);
         if ($formulaireEleve->isSubmitted() && $formulaireEleve->isValid())
         {
            // Enregistrer la ressource en base de donnée
            $manager->persist($eleve);
            $manager->flush();
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('gestionEleves');
         }
        // Afficher la page présentant le formulaire d'ajout d'un eleve
        return $this->render('eleve/ConsulterEleveId.html.twig', ['form' => $formulaireEleve->createView(), 'action'=>"modifier"]);
    }

    

    //-------------------------------Modifier------------------------------//

    /**
     * @Route("/modifierEleve", name="ModifierEleve", methods={"GET"})
     */
    public function modifierEleve(EleveRepository $eleveRepository): Response
    {
        return $this->render('eleve/ModifierEleve.html.twig', [
            'eleves' => $eleveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/modifierEleve/{id}", name="ModifierEleveId", methods={"GET","POST"})
     */
    public function modifierEleveId(Request $request, Eleve $eleve): Response
    {
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ModifierEleve', [
                'id' => $eleve->getId(),
            ]);
        }

        return $this->render('eleve/ModifierEleveId.html.twig', [
            'eleve' => $eleve,
            'form' => $form->createView(),
        ]);
    }
}
