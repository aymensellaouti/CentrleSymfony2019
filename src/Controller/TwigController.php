<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    /**
     * @Route("/twig", name="twig")
     */
    public function index()
    {
        return $this->render('twig/index.html.twig', [
            'controller_name' => 'TwigController',
        ]);
    }

    /**
     * @Route("/tab/{nombre?5<\d+>}", name="tab.rand")
     */
    public function randTable($nombre){
        $table = [];
        for ($i = 0 ; $i < $nombre ; $i++) {
            $table[$i] = rand(0,100);
        }
        return $this->render('twig/random.html.twig',array(
           'tableau' => $table
        ));
    }
}
