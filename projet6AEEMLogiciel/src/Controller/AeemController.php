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
}
