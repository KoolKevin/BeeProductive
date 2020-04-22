<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    }