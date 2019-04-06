<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Repository\EtablissementRepository;
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
     * @Route("/supprimerEtablissement/{parametre}", name="SupprimerEtablissement", methods={"GET"})
     */
    public function supprimerEtablissement(EtablissementRepository $etablissementRepository, $parametre = "Parametre"): Response
     {
        if($parametre != "Parametre"){
            if(($parametre == "Primaire") || ($parametre == "Collège") || ($parametre == "Lycée")){        
                return $this->render('etablissement/SupprimerEtablissement.html.twig', [
                'etablissements' => $etablissementRepository->findByType($parametre),
                ]);
            }
            else{
                return $this->render('etablissement/SupprimerEtablissement.html.twig', [
                'etablissements' => $etablissementRepository->findByVille($parametre),
                ]);
            }
        }

        return $this->render('etablissement/SupprimerEtablissement.html.twig', [
             'etablissements' => $etablissementRepository->findAll(),
        ]);
     }

    /**
     * @Route("/supprimerEtablissement/FicheEtablissement/{id}", name="SupprimerEtablissementId", methods={"DELETE"})
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
     * @Route("/consulterEtablissement/{parametre}", name="ConsulterEtablissement", methods={"GET"})
     */
    public function consulterEtablissement(EtablissementRepository $etablissementRepository, $parametre = "Parametre"): Response
     {
        if($parametre != "Parametre"){
            if(($parametre == "Primaire") || ($parametre == "Collège") || ($parametre == "Lycée")){        
                return $this->render('etablissement/ConsulterEtablissement.html.twig', [
                'etablissements' => $etablissementRepository->findByType($parametre),
                ]);
            }
            else{
                return $this->render('etablissement/ConsulterEtablissement.html.twig', [
                'etablissements' => $etablissementRepository->findByVille($parametre),
                ]);
            }
        }

         return $this->render('etablissement/ConsulterEtablissement.html.twig', [
             'etablissements' => $etablissementRepository->findAll(),
         ]);
     }

    /**
     * @Route("/consulterEtablissement/FicheEtablissement/{id}", name="ConsulterEtablissementId", methods={"GET"})
     */
    public function consulterEtablissementId(Etablissement $etablissement, Request $request, $id): Response
    {
        //Ouverture de session afin de pouvoir récupérer l'id après l'actualisation de la page par la fonction PDF
        $session = new Session();
        $session->set('id', $id);

        $formulaireEtablissement = $this->createForm(EtablissementType::class, $etablissement);

        $formulaireEtablissement->handleRequest($request);
         
        // Afficher la page présentant le formulaire d'ajout d'une etablissement
        return $this->render('etablissement/ConsulterEtablissementId.html.twig', ['form' => $formulaireEtablissement->createView(), 'id' => $id]);
    }




    //-------------------------------Modifier------------------------------//

    /**
     * @Route("/modifierEtablissement/{parametre}", name="ModifierEtablissement", methods={"GET"})
     */
    public function modifierEtablissement(EtablissementRepository $etablissementRepository, $parametre = "Parametre"): Response
    {
        if($parametre != "Parametre"){
            if(($parametre == "Primaire") || ($parametre == "Collège") || ($parametre == "Lycée")){        
                return $this->render('etablissement/ModifierEtablissement.html.twig', [
                'etablissements' => $etablissementRepository->findByType($parametre),
                ]);
            }
            else{
                return $this->render('etablissement/ModifierEtablissement.html.twig', [
                'etablissements' => $etablissementRepository->findByVille($parametre),
                ]);
            }
        }

        return $this->render('etablissement/ModifierEtablissement.html.twig', [
            'etablissements' => $etablissementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/modifierEtablissement/FicheEtablissement/{id}", name="ModifierEtablissementId", methods={"GET","POST"})
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

    //-------------------------------PDF------------------------------//

    /**
     * @Route("/pdf/{id}", name="pdfFunctionEtablissement", methods={"GET"})
     */
    public function pdfFunction(EtablissementRepository $etablissementRepository, Request $request,$id){

        $etablissement = $etablissementRepository->findOneById($id);

        $formulaireEtablissement = $this->createForm(EtablissementType::class, $etablissement);

        $formulaireEtablissement->handleRequest($request);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('etablissement/ConsulterEtablissementId.html.twig', [
            'title' => "Fiche établissement", 'form' => $formulaireEtablissement->createView()
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("ficheEtablissement.pdf", [
            "Attachment" => true
        ]);
         
    }

}
