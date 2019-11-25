<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
    /**
     * @Route("/", name="personne")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repo->findAll();
        return $this->render('personne/index.html.twig', array(
            'personnes' => $personnes
        ));
    }

    /**
     * @Route("/detail/{id<\d+>}")
     */
    public function detailPersonne(Personne $personne = null) {
        return $this->render('personne/detail.html.twig',
            array(
                'personne' => $personne
            )
        );
    }

    /**
     * @Route("/delete/{id<\d+>}")
     */
    public function deletePersonne(Personne $personne = null) {
        if ($personne) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($personne);
            $manager->flush();
        }
        return $this->forward('App\Controller\PersonneController::index');
    }

    /**
     * @Route("/add/{name}/{firstname}/{age}/{cin?11111}/{path?as.jpg}", name="personne.add")
     */
    public function addPersonne($name, $firstname, $age, $cin, $path) {
        $personne = new Personne();
        $personne->setAge($age);
        $personne->setName($name);
        $personne->setPath($path);
        $personne->setFirstname($firstname);
        $personne->setCin($cin);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($personne);
        $manager->flush();

    }
}
