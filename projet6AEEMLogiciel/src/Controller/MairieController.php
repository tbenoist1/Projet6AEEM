<?php

namespace App\Controller;

use App\Entity\Mairie;
use App\Form\MairieType;
use App\Repository\MairieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestionSubventions")
 */
class MairieController extends AbstractController
{
    
    //-------------------------------Accueil------------------------------//    

    /**
     * @Route("/", name="GestionSubventions")
     */
    public function gestionSubventions()
    {
        return $this->render('mairie/GestionSubventions.html.twig');
    }




    //-------------------------------Ajouter------------------------------//

    /**
     * @Route("/ajouterMairie", name="AjouterMairie", methods={"GET","POST"})
     */
    public function ajouterMairie(Request $request): Response
    {
        $mairie = new Mairie();
        $form = $this->createForm(MairieType::class, $mairie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mairie);
            $entityManager->flush();

            return $this->redirectToRoute('GestionSubventions');
        }

        return $this->render('mairie/AjouterMairie.html.twig', [
            'mairie' => $mairie,
            'form' => $form->createView(),
        ]);
    }




    //-------------------------------Supprimer------------------------------//

    /**
     * @Route("/supprimerMairie", name="SupprimerMairie", methods={"GET"})
     */
    public function supprimerMairie(MairieRepository $mairieRepository): Response
    {
        return $this->render('mairie/SupprimerMairie.html.twig', [
            'mairies' => $mairieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/supprimerMairie/{id}", name="SupprimerMairieId", methods={"DELETE"})
     */
    public function supprimerMairieId(Request $request, Mairie $mairie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mairie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mairie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('SupprimerMairie');
    }




    //-------------------------------Consuter------------------------------//

    /**
     * @Route("/consulterMairie", name="ConsulterMairie", methods={"GET"})
     */
    public function consulterMairie(MairieRepository $mairieRepository): Response
     {
         return $this->render('mairie/ConsulterMairie.html.twig', [
             'mairies' => $mairieRepository->findAll(),
         ]);
     }

    /**
     * @Route("/consulterMairie/{id}", name="ConsulterMairieId", methods={"GET"})
     */
    public function consulterMairieId(Mairie $mairie, Request $request): Response
    {
       $formulaireMairie = $this->createForm(MairieType::class, $mairie);

        $formulaireMairie->handleRequest($request);
         if ($formulaireMairie->isSubmitted() && $formulaireMairie->isValid())
         {
            // Enregistrer la ressource en base de donnée
            $manager->persist($mairie);
            $manager->flush();
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('gestionSubventions');
         }
        // Afficher la page présentant le formulaire d'ajout d'une mairie
        return $this->render('mairie/ConsulterMairieId.html.twig', ['form' => $formulaireMairie->createView()]);
    }




    //-------------------------------Modifier------------------------------//

    /**
     * @Route("/modifierMairie", name="ModifierMairie", methods={"GET"})
     */
    public function modifierMairie(MairieRepository $mairieRepository): Response
    {
        return $this->render('mairie/ModifierMairie.html.twig', [
            'mairies' => $mairieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/modifierMairie/{id}", name="ModifierMairieId", methods={"GET","POST"})
     */
    public function modifierMairieId(Request $request, Mairie $mairie): Response
    {
        $form = $this->createForm(MairieType::class, $mairie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ModifierMairie', [
                'id' => $mairie->getId(),
            ]);
        }

        return $this->render('mairie/ModifierMairieId.html.twig', [
            'mairie' => $mairie,
            'form' => $form->createView(),
        ]);
    }

}
