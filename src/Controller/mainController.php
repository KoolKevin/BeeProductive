<?php

namespace App\Controller;

use App\Entity\Test;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

    class mainController extends AbstractController{   
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