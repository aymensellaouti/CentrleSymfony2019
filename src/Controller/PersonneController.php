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
     * @Route("/detail/{id<\d+>}", name="personne.detail")
     */
    public function detailPersonne(Personne $personne = null) {
        return $this->render('personne/detail.html.twig',
            array(
                'personne' => $personne
            )
        );
    }

    /**
     * @Route("/delete/{id<\d+>}", name="personne.delete")
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

    /**
     * @Route("/find/{name}/{limit?5}/{offset?0}", name="personne.find.name")
     */
    public function findPersonneByName($name, $limit, $offset) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->findBy(
            array('name' => $name),
            array('firstname' => 'Desc'),
            $limit,
            $offset
        );
        return $this->render('personne/index.html.twig', array('personnes' => $personnes));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/stats", name="personne.stats")
     */
    public function statsPersonne(){
        $repo = $this->getDoctrine()->getRepository(Personne::class);
        $stats = $repo->getSumAVGAge();
        return $this->render('personne/stats.html.twig', array(
            'stats' => $stats
        ));
    }
}
