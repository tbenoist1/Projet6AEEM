<?php

namespace App\Controller;

use App\Entity\Mairie;
use App\Form\Mairie1Type;
use App\Repository\MairieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mairie")
 */
class MairieController extends AbstractController
{
    /**
     * @Route("/", name="mairie_index", methods={"GET"})
     */
    public function index(MairieRepository $mairieRepository): Response
    {
        return $this->render('mairie/index.html.twig', [
            'mairies' => $mairieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mairie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mairie = new Mairie();
        $form = $this->createForm(Mairie1Type::class, $mairie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mairie);
            $entityManager->flush();

            return $this->redirectToRoute('mairie_index');
        }

        return $this->render('mairie/new.html.twig', [
            'mairie' => $mairie,
            'form' => $form->createView(),
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
        $form = $this->createForm(Mairie1Type::class, $mairie);
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
