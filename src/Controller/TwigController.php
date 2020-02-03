<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TwigController
 * @package App\Controller
 *
 * Préfixe de route : toutes les url définies dans les routes de ce controller seront préfixées par /twig
 * @Route("/twig")
 */
class TwigController extends AbstractController
{
    /**
     * l'url de cette route es /twig ou /twig/ parce qu'il ya le prefixe de route defini sur la classe
     * @Route("/")
     */
    public function index()
    {
        $test = 'variable de test dans le controller';
        dump($test);

        return $this->render('twig/index.html.twig', [
            'demain'=>new \DateTime('+1day')
        ]);
    }
}
