<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondController extends AbstractController
{
    /**
     * @Route("/second", name="second")
     */
    public function index()
    {
        return $this->render('second/index.html.twig', [
            'controller_name' => 'SecondController',
        ]);
    }

    /**
     * @Route("/test/{section}")
     */
    public function first(Request $request, $section) {
        return $this->render('second/index.html.twig',[
            'maSection' => $section
        ]);
    }
}
