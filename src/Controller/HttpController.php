<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HttpController
 * @package App\Controller
 * @Route("/http")
 */
class HttpController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('http/index.html.twig', [
            'controller_name' => 'HttpController',
        ]);
    }

    /**
     * @Route("/request")
     */
    public function request(Request $request)
    {
        http://localhost:8000/http/request?nom=Krikor&prenom=Joss
        dump($_GET); // array:2 [▼"nom" => "Krikor",  "prenom" => "Joss"]

        // $resuest->query est une surcouche en objet au tableau $_GET
        dump($request->query->all()); // array:2 [▼"nom" => "Krikor",  "prenom" => "Joss"]

        dump($request->query->get('nom'));  // 'Krikor'

        dump($request->query->get('surnom'));  // 'null'

        // optionnel : valeur par défaut si null
        dump($request->query->get('surnom', 'John Doe'));  // 'John Doe'

        // isset($_GET['surnom']
        dump($request->query->has('surnom')); // false

        dump($request->getMethod());

        if($request->isMethod('POST')){  // $request->getMethod() == 'POST'
            // $request->request est une surcouche en objet au tableau POST
            dump($request->request->all());
        }


        return $this->render('http/request.html.twig');
    }

//    public function session(Request $request)
//    {
//        // pour acceder a la session depuis l'objet Request
//        $session = $request->getSession();
//    }

    /**
     * @param SessionInterface $session
     *
     * @Route("/session")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function session(SessionInterface $session)
    {
        $session->set('nom', 'Krikorian');
        $session->set('prenom', 'Josselin');

        // les elemts stockés par l'objet Session le sont dans $_SESSION['_sf2_attributes']

        dump($_SESSION);

        // tous les éléments de la session
        dump($session->all());

        dump($session->get('prenom'));

        // supprimer un elmt de la session
        $session->remove('nom');

        dump($session->all());

        dump($session->clear());

        dump($session->all());

        $session->set('user', ['prenom'=>'Groucho', 'nom'=>'Marx']);
        dump($session->all());


        return $this->render('http/session.html.twig');
    }

    /**
     * @Route("/response")
     * @param Request $request
     * @return Response
     */
    public function response(Request $request)
    {
        // pour retourner une reponse simple sans faire de template
        $response = new Response('Contenu de la page');

        http://localhost:8000/http/response?type=twig
        if($request->query->get('type') == 'twig'){
            // $this->render() retourne un objet instance de la classe Response
            // dont le contenu est le HTML construit par le template
            return $this->render('http/response.html.twig');
        }
        return $response;
    }
}
