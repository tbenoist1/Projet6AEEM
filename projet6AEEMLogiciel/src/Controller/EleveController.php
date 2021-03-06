<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Include Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;
//Include Session
use Symfony\Component\HttpFoundation\Session\Session;


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
     * @Route("/supprimerEleve/{parametre}", name="SupprimerEleve", methods={"GET"})
     */
    public function supprimerEleve(EleveRepository $eleveRepository, $parametre = "Parametre"): Response
     {
        if($parametre != "Parametre"){       
            return $this->render('eleve/SupprimerEleve.html.twig', [
            'eleves' => $eleveRepository->findByNiveau($parametre),
            ]);
        }

        return $this->render('eleve/SupprimerEleve.html.twig', [
            'eleves' => $eleveRepository->findAll(),
        ]);
     }

    /**
     * @Route("/supprimerEleve/FicheEleve/{id}", name="SupprimerEleveId", methods={"DELETE"})
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
     * @Route("/consulterEleve/{parametre}", name="ConsulterEleve", methods={"GET"})
     */
    public function consulterEleve(EleveRepository $eleveRepository, $parametre = "Parametre"): Response
     {
        if($parametre != "Parametre"){       
            return $this->render('eleve/ConsulterEleve.html.twig', [
            'eleves' => $eleveRepository->findByNiveau($parametre),
            ]);
        }


        return $this->render('eleve/ConsulterEleve.html.twig', [
            'eleves' => $eleveRepository->findAll(),
        ]);
     }

    /**
     * @Route("/consulterEleve/FicheEleve/{id}", name="ConsulterEleveId", methods={"GET"})
     */
    public function consulterEleveId(Eleve $eleve, Request $request, $id): Response
    {
        //Ouverture de session afin de pouvoir récupérer l'id après l'actualisation de la page par la fonction PDF
        $session = new Session();
        $session->set('id', $id);
        
        $formulaireEleve = $this->createForm(EleveType::class, $eleve);

        $formulaireEleve->handleRequest($request);
         
        // Afficher la page présentant le formulaire d'ajout d'une eleve
        return $this->render('eleve/ConsulterEleveId.html.twig', ['form' => $formulaireEleve->createView(), 'id' => $id]);
    }




    //-------------------------------Modifier------------------------------//

    /**
     * @Route("/modifierEleve/{parametre}", name="ModifierEleve", methods={"GET"})
     */
    public function modifierEleve(eleveRepository $eleveRepository, $parametre = "Parametre"): Response
    {
        if($parametre != "Parametre"){       
            return $this->render('eleve/ModifierEleve.html.twig', [
            'eleves' => $eleveRepository->findByNiveau($parametre),
            ]);
        }

        return $this->render('eleve/ModifierEleve.html.twig', [
            'eleves' => $eleveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/modifierEleve/FicheEleve/{id}", name="ModifierEleveId", methods={"GET","POST"})
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

    //-------------------------------PDF------------------------------//

    /**
     * @Route("/pdf/{id}", name="pdfFunctionEleve", methods={"GET"})
     */
    public function pdfFunction(EleveRepository $eleveRepository, Request $request,$id){

        $eleve = $eleveRepository->findOneById($id);

        $formulaireEleve = $this->createForm(EleveType::class, $eleve);

        $formulaireEleve->handleRequest($request);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('eleve/ConsulterEleveId.html.twig', [
            'title' => "Fiche élève", 'form' => $formulaireEleve->createView()
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("ficheEleve.pdf", [
            "Attachment" => true
        ]);
         
    }

}