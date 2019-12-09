<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FormationController
 * @package App\Controller
 * @Route("/formation")
 */
class FormationController extends AbstractController
{
    /**
     * @Route("/", name="formation.list")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Formation::class);
        $formations = $repo->findAll();
        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    /**
     * @Route("/add/{id?0}", name="formation.add")
     */
    public function addFormation(Request $request, Formation $formation = null)  {
     if(!$formation)
        $formation = new Formation();
     $form = $this->createForm(FormationType::class,$formation);
//     $form->remove('createdAt');
//     $form->remove('modifiedAt');
//     $form->remove('etudiants');

     $form->handleRequest($request);
//     dd($formation);
        if ($form->isSubmitted() && $form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($formation);
           $em->flush();
           return $this->redirectToRoute('formation.list');
        }
     return $this->render("formation/add.html.twig", array(
        'form' => $form->createView()
     ));
    }
}
