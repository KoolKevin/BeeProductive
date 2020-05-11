<?php

namespace App\Controller;

use App\Entity\Test;
use App\Entity\UserSession;
use App\Entity\User;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Doctrine\ORM\EntityManagerInterface;

    class mainController extends AbstractController{

        private $session;

        public function __construct(SessionInterface $session){

            $this->session = $session;

        }


        /**
        * @Route("/home")
        */
        public function home() {
            return $this->render('index.html.twig');
        }

        /**
        * @Route("/calendario")
        */
        public function calendario() {
            return $this->render('calendario.html.twig');
        }

        /**
        * @Route("/test")
        */
        public function test() {
            $entityManager = $this->getDoctrine()->getManager();

            $test = new Test();
            $test->setFunziona(true);


            // tell Doctrine you want to (eventually) save the Product
            $entityManager->persist($test);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->render('index.html.twig');
        }
    }
