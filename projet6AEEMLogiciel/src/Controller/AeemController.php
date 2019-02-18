<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AeemController extends AbstractController
{
    /**
     * @Route("/aeem", name="aeem")
     */
    public function index()
    {
        return $this->render('aeem/index.html.twig', [
            'controller_name' => 'AeemController',
        ]);
    }
}
