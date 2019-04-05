<?php

namespace App\Controller;

use App\Entity\Mairie;
use App\Form\MairieType;
use App\Repository\MairieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Session\Session; // a virer ?


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
     * @Route("/supprimerMairie/{zone}", name="SupprimerMairie", methods={"GET"})
     */
    public function supprimerMairie(MairieRepository $mairieRepository, $zone ="Zone"): Response
     {
        if($zone != "Zone"){        
            return $this->render('mairie/SupprimerMairie.html.twig', [
             'mairies' => $mairieRepository->findByZone($zone),
         ]);
        }

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
     * @Route("/consulterMairie/{zone}", name="ConsulterMairie", methods={"GET"})
     */
    public function consulterMairie(MairieRepository $mairieRepository, $zone ="Zone"): Response
     {
       
        if($zone != "Zone"){        
            return $this->render('mairie/ConsulterMairie.html.twig', [
             'mairies' => $mairieRepository->findByZone($zone),
         ]);
        }

         return $this->render('mairie/ConsulterMairie.html.twig', [
             'mairies' => $mairieRepository->findAll(),
         ]);
     }

    /**
     * @Route("/consulterMairie/{id}", name="ConsulterMairieId", methods={"GET"})
     */
    public function consulterMairieId(MairieRepository $mairieRepository, Mairie $mairie, Request $request, $id): Response
    {

        $session = new Session();
        //$session->start();
        $session->set('id', $id);

       $formulaireMairie = $this->createForm(MairieType::class, $mairie);

        $formulaireMairie->handleRequest($request);
dump($mairieRepository->findOneById($id));

        // Afficher la page présentant le formulaire d'ajout d'une mairie
        return $this->render('mairie/ConsulterMairieId.html.twig', ['form' => $formulaireMairie->createView(), 'id' => $id,]);
    }




    //-------------------------------Modifier------------------------------//

    /**
     * @Route("/modifierMairie/{zone}", name="ModifierMairie", methods={"GET"})
     */
    public function modifierMairie(MairieRepository $mairieRepository, $zone ="Zone"): Response
    {
        if($zone != "Zone"){        
            return $this->render('mairie/ModifierMairie.html.twig', [
             'mairies' => $mairieRepository->findByZone($zone),
         ]);
        }

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

    //-------------------------------PDF------------------------------//

    /**
     * @Route("/pdf/{id}", name="pdfFunctionMairie", methods={"GET"})
     */
    public function pdfFunction(MairieRepository $mairieRepository, Request $request, $id){

        $mairie = $mairieRepository->findOneById($id);

        $formulaireMairie = $this->createForm(MairieType::class, $mairie);

        $formulaireMairie->handleRequest($request);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('mairie/ConsulterMairieId.html.twig', [
            'title' => "pdf", 'form' => $formulaireMairie->createView()
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }


}
