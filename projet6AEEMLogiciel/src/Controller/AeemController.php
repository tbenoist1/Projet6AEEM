<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/GestionEleves", name="GestionEleves")
     */
    public function GestionEleves()
    {
        return $this->render('aeem/GestionEleves.html.twig');
    }

     /**
     * @Route("/GestionProfesseurs", name="GestionProfesseurs")
     */
    public function GestionProfesseurs()
    {
        return $this->render('aeem/GestionProfesseurs.html.twig');
    }

     /**
     * @Route("/GestionEtablissements", name="GestionEtablissements")
     */
    public function GestionEtablissements()
    {
        return $this->render('aeem/GestionEtablissements.html.twig');
    }

     /**
     * @Route("/GestionSubventions", name="GestionSubventions")
     */
    public function GestionSubventions()
    {
        return $this->render('aeem/GestionSubventions.html.twig');
    }
}
