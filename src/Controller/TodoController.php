<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo", name="todo")
     */
    public function index(Request $request)
    {
        //Recupérer la session
        $session = $request->getSession();
        // Verifier si le tableau des todos existe ou pas
        // si n'existe pas
        if(!$session->has('todos')) {
            // tu crée le tableau des todos
            $todos = array(
                'achat'=>'acheter clé usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
            );
            // on le met dans la session
            $session->set('todos',$todos);
            // on cree un flash messsage de succes
            $session->getFlashBag()->add('info', 'Session initialisée avec succès :)');
        }
        return $this->render('todo/index.html.twig');
    }
}
