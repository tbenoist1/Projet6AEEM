<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Eleve;
use App\Entity\Professeur;
use App\Entity\Etablissement;
use App\Entity\Mairie;

use App\Form\EleveType;
use App\Form\ProfesseurType;
use App\Form\EtablissementType;
use App\Form\MairieType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class AeemController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */
    public function index()
    {
        return $this->render('aeem/index.html.twig');
    }

    /**
     * @Route("/GestionEleves/AjouterEleve", name="AjouterEleve")
     */
    public function ajouterEleve(Request $request, ObjectManager $manager)
    {
        //Création d'un stage vierge qui sera remplie par le formulaire
        $eleve = new Eleve();

        $formulaireEleve = $this->createForm(EleveType::class, $eleve);
        
        $formulaireEleve->handleRequest($request);

         if ($formulaireEleve->isSubmitted() && $formulaireEleve->isValid())
         {
            // Enregistrer le stage en base de donnée
            $manager->persist($eleve);
            $manager->flush();
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('Accueil');
         }

        // Afficher la page présentant le formulaire d'ajout d'un stage
        return $this->render('aeem/AjouterEleve.html.twig',['vueFormulaire' => $formulaireEleve->createView()]);
    }

    /**
     * @Route("/GestionProfesseurs/AjouterProfesseur", name="AjouterProfesseur")
     */
    public function ajouterProfesseur(Request $request, ObjectManager $manager)
    {
        //Création d'un stage vierge qui sera remplie par le formulaire
        $professeur = new Professeur();

        $formulaireProfesseur = $this->createForm(ProfesseurType::class, $professeur);
        
        $formulaireProfesseur->handleRequest($request);

         if ($formulaireProfesseur->isSubmitted() && $formulaireProfesseur->isValid())
         {
            // Enregistrer le stage en base de donnée
            $manager->persist($professeur);
            $manager->flush();
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('Accueil');
         }

        // Afficher la page présentant le formulaire d'ajout d'un stage
        return $this->render('aeem/AjouterProfesseur.html.twig',['vueFormulaire' => $formulaireProfesseur->createView()]);
    }

    /**
     * @Route("/GestionEtablissements/AjouterEtablissement", name="AjouterEtablissement")
     */
    public function ajouterEtablissement(Request $request, ObjectManager $manager)
    {
        //Création d'un stage vierge qui sera remplie par le formulaire
        $etablissement = new Etablissement();

        $formulaireEtablissement = $this->createForm(EtablissementType::class, $etablissement);
        
        $formulaireEtablissement->handleRequest($request);

         if ($formulaireEtablissement->isSubmitted() && $formulaireEtablissement->isValid())
         {
            // Enregistrer le stage en base de donnée
            $manager->persist($etablissement);
            $manager->flush();
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('Accueil');
         }

        // Afficher la page présentant le formulaire d'ajout d'un stage
        return $this->render('aeem/AjouterEtablissement.html.twig',['vueFormulaire' => $formulaireEtablissement->createView()]);
    }

    /**
     * @Route("/GestionSubventions/AjouterMairie", name="AjouterMairie")
     */
    public function ajouterMairie(Request $request, ObjectManager $manager)
    {
        //Création d'un stage vierge qui sera remplie par le formulaire
        $mairie = new Mairie();

        $formulaireMairie = $this->createForm(MairieType::class, $mairie);
        
        $formulaireMairie->handleRequest($request);

         if ($formulaireMairie->isSubmitted() && $formulaireMairie->isValid())
         {
            // Enregistrer le stage en base de donnée
            $manager->persist($mairie);
            $manager->flush();
            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('Accueil');
         }

        // Afficher la page présentant le formulaire d'ajout d'un stage
        return $this->render('aeem/AjouterMairie.html.twig',['vueFormulaire' => $formulaireMairie->createView()]);
    }
}
