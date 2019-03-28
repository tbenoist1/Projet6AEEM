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
    /**
     * @Route("/", name="GestionSubventions")
     */
    public function gestionSubventions()
    {
        return $this->render('mairie/GestionSubventions.html.twig');
    }

    /**
     * @Route("/liste", name="mairie_index", methods={"GET"})
     */
    public function index(MairieRepository $mairieRepository): Response
    {
        return $this->render('mairie/index.html.twig', [
            'mairies' => $mairieRepository->findAll(),
        ]);
    }

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
     * @Route("/modifierMairie", name="ModifierMairie", methods={"GET"})
     */
    public function modifierMairie(MairieRepository $mairieRepository): Response
    {
        return $this->render('mairie/ModifierMairie.html.twig', [
            'mairies' => $mairieRepository->findAll(),
        ]);
    }

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
     * @Route("/{id}", name="mairie_show", methods={"GET"})
     */
    public function show(Mairie $mairie): Response
    {
        return $this->render('mairie/show.html.twig', [
            'mairie' => $mairie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mairie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mairie $mairie): Response
    {
        $form = $this->createForm(MairieType::class, $mairie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mairie_index', [
                'id' => $mairie->getId(),
            ]);
        }

        return $this->render('mairie/edit.html.twig', [
            'mairie' => $mairie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mairie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mairie $mairie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mairie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mairie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mairie_index');
    }
}
