<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TemplateController
 * @package App\Controller
 * @Route("/template")
 */
class TemplateController extends AbstractController
{
    /**
     * @Route("/", name="template")
     */
    public function index()
    {
        return $this->render('template/index.html.twig', [
            'controller_name' => 'TemplateController',
        ]);
    }

    /**
     * @Route("/first")
     */
    public function first() {
       return $this->render('template/first.html.twig');
    }
}
