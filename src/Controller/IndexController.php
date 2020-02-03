<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * Page à la racine du nom de domaine
     * @Route("/")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * localhost:8000/hello
     *
     * URL de la page
     * @Route("/hello")
     */
    public function hello()
    {
        // Rendu du fichier qui construit le html contenu dans la page.
        // Chemin à partir de la racine du répertoire templates
        return $this->render('index/hello.html.twig');
    }

    /**
     * une  route avec une partie variable (entre accolades)
     * le $qui en parametre de la methode (meme nom que dans la route)
     * contient la valeur de cette partie variable
     *
     * @Route("/bonjour/{qui}")
     */
    public function bonjour($qui)
    {
        //echo $qui;

        return $this->render(
            'index/bonjour.html.twig',
            [
                'nom' => $qui
            ]
        );
    }

    /**
     *  Partie variable de la route optionnelle (avec une valeur par défault) :
     * La route match /salut/unNom : $qui vaut unNom
     * et match aussi /salut et /salut/ : qui vaut "à toi"
     *
     * @Route("/salut/{qui}", defaults={"qui": "à toi"})
     */
    public function salut($qui)
    {
        return $this->render(
            'index/salut.html.twig',
            [
                'qui' => $qui
            ]
        );
    }

    /**
     *  id doit etre un nombre (\d+ en expression régulière)
     *
     * @Route("/categorie/{id}", requirements={"id": "\d+"})
     */
    public function categorie($id)
    {
        return $this->render(
            'index/categorie.html.twig',
            [
                'id' => $id
            ]
        );
    }
}
