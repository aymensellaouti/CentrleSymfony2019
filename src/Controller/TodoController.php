<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TodoController
 * @package App\Controller
 * @Route("/todo")
 */
class TodoController extends AbstractController
{
    /**
     * @Route("/", name="todo")
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

    /**
     * @param Request $request
     * @Route("/add/{name}/{content}", name="todo.add")
     */
    public function add(Request $request, $name, $content) {
        $session = $request->getSession();
        if(!$session->has('todos')) {
            $session->getFlashBag()->add('error', 'Session non encore initialisée :(');
        } else {
            $todos = $session->get('todos');
            if(isset($todos[$name])){
                $session->getFlashBag()->add('error', " le todo de clé $name existe déjà :(");
            } else {
                $todos[$name]=$content;
                $session->set('todos', $todos);
                $session->getFlashBag()->add('success', "Le Todo $name a été ajouté avec suuccès :)");
            }
        }
        return $this->redirectToRoute('todo');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/vider", name="todo.vider")
     */
    public function viderSession(Request $request) {
        $request->getSession()->clear();
        return new Response("<h1>Session vidée</h>");
    }

    /**
     * @Route(
     *     "/update/{name}/{content}",
     *      name="todo.update",
     *      defaults={"content" : "new value"}
     * )
     */
    public function update(Request $request, $name, $content) {
        // récupérer la session à travers l'objet request
        $session = $request->getSession();
        //vérifie est ce qu'il y a une varibale dans la session qui
        //s'appelle todo
        if(!$session->has('todos')) {
            $session->getFlashBag()->add('error', 'Session non encore initialisée :(');
        } else {
            $todos = $session->get('todos');
            if(!isset($todos[$name])){
                $session->getFlashBag()->add('error', " le todo de clé $name n'existe pas :(");
            } else {
                $todos[$name]=$content;
                $session->set('todos', $todos);
                $session->getFlashBag()->add('success', "Le Todo $name a été mis à jour avec suuccès :)");
            }
        }
        return $this->redirectToRoute('todo');
    }

    /**
     * @Route("/delete/{name}", name="todo.delete")
     */
    public function delete(Request $request, $name) {
        // récupérer la session à travers l'objet request
        $session = $request->getSession();
        //vérifie est ce qu'il y a une varibale dans la session qui
        //s'appelle todo
        if(!$session->has('todos')) {
            $session->getFlashBag()->add('error', 'Session non encore initialisée :(');
        } else {
            $todos = $session->get('todos');
            if(!isset($todos[$name])){
                $session->getFlashBag()->add('error', " le todo de clé $name n'existe pas :(");
            } else {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $session->getFlashBag()->add('success', "Le Todo $name a été supprimé avec suuccès :)");
            }
        }
        return $this->redirectToRoute('todo');
    }
    /**
     * @Route("/reset", name="todo.reset")
     */
    public function reset(Request $request) {
        // récupérer la session à travers l'objet request
        $session = $request->getSession();
        //vérifie est ce qu'il y a une varibale dans la session qui
        //s'appelle todo
        if(!$session->has('todos')) {
            $session->getFlashBag()->add('error', 'Session non encore initialisée :(');
        } else {
                $session->clear();
                $session->getFlashBag()->add('success', "Session réinitialisée avec suucès :)");
        }
        return $this->redirectToRoute('todo');
    }
}
