<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route("/first", name="first")
     */
    public function index(Request $request)
    {
//        dump($request);
//        $response = new Response();
//        $response->setContent("<h1>Hello World</h1>");
//        $response->setStatusCode(200);
        //        $responseJson = new JsonResponse(array(
//            'name' => 'Sellaouti',
//            'firstname' => 'Aymen'
//        ));
//        return $responseJson;
        return $this->render('first/index.html.twig', array(
            'esm' => 'aymen'
        ));
    }

    /**
     * @return Response
     * @Route("/second", name="second")
     */
    public function second() {
        return $this->render('first/second.html.twig');
    }
}
