<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestionEtablissements")
 */
class EtablissementController extends AbstractController
{

    //-------------------------------Accueil------------------------------// 
    
    /**
     * @Route("/", name="GestionEtablissements")
     */
    public function gestionEtablissements()
    {
        return $this->render('etablissement/GestionEtablissements.html.twig');
    }




    //-------------------------------Ajouter------------------------------//

    /**
     * @Route("/ajouterEtablissement", name="AjouterEtablissement", methods={"GET","POST"})
     */
    public function ajouterEtablissement(Request $request): Response
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etablissement);
            $entityManager->flush();

            return $this->redirectToRoute('GestionEtablissements');
        }

        return $this->render('etablissement/AjouterEtablissement.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form->createView(),
        ]);
    }




    //-------------------------------Supprimer------------------------------//

    /**
     * @Route("/supprimerEtablissement", name="SupprimerEtablissement", methods={"GET"})
     */
    public function supprimerEtablissement(EtablissementRepository $etablissementRepository): Response
     {
         return $this->render('etablissement/SupprimerEtablissement.html.twig', [
             'etablissements' => $etablissementRepository->findAll(),
         ]);
     }

    /**
     * @Route("/supprimerEtablissement/{id}", name="SupprimerEtablissementId", methods={"DELETE"})
     */
    public function supprimerEtablissementId(Request $request, Etablissement $etablissement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etablissement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etablissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('SupprimerEtablissement');
    }




    //-------------------------------Consuter------------------------------//

    /**
     * @Route("/consulterEtablissement", name="ConsulterEtablissement", methods={"GET"})
     */
    public function consulterEtablissement(EtablissementRepository $etablissementRepository): Response
     {
         return $this->render('etablissement/ConsulterEtablissement.html.twig', [
             'etablissements' => $etablissementRepository->findAll(),
         ]);
     }

    /**
     * @Route("/consulterEtablissement/{id}", name="ConsulterEtablissementId", methods={"GET"})
     */
    public function consulterEtablissementId(Etablissement $etablissement, Request $request): Response
    {
       $formulaireEtablissement = $this->createForm(EtablissementType::class, $etablissement);

        $formulaireEtablissement->handleRequest($request);
         if ($formulaireEtablissement->isSubmitted() && $formulaireetablissement->isValid())
         {
        
            $manager->persist($etablissement);
            $manager->flush();
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('GestionEtablissements');
         }
        // Afficher la page présentant le formulaire d'ajout d'une etablissement
        return $this->render('etablissement/ConsulterEtablissementId.html.twig', ['form' => $formulaireEtablissement->createView()]);
    }




    //-------------------------------Modifier------------------------------//

    /**
     * @Route("/modifierEtablissement", name="ModifierEtablissement", methods={"GET"})
     */
    public function modifierEtablissement(EtablissementRepository $etablissementRepository): Response
    {
        return $this->render('etablissement/ModifierEtablissement.html.twig', [
            'etablissements' => $etablissementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/modifierEtablissement/{id}", name="ModifierEtablissementId", methods={"GET","POST"})
     */
    public function modifierEtablissementId(Request $request, Etablissement $etablissement): Response
    {
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ModifierEtablissement', [
                'id' => $etablissement->getId(),
            ]);
        }

        return $this->render('etablissement/ModifierEtablissementId.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form->createView(),
        ]);
    }

}
