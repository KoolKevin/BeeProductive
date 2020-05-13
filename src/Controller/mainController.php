<?php

namespace App\Controller;

use App\Entity\Test;
use App\Entity\Eventi;
use App\Entity\Progetti;
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
            $evento = new Eventi();

            $user = $this->getDoctrine()->getRepository(User::class)->find(1);
            $progetto = $this->getDoctrine()->getRepository(Progetti::class)->find(1);

            $evento->setFkIdUtente($user);
            $evento->setFkIdProgetto($progetto);
            //$evento->setFkIdUtente(1);
            //$evento->setFkIdProgetto(1);

            $evento->setStartDate("0/0/0");
            $evento->setTitolo("prova");
            $evento->setPriorita(1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evento);
            $entityManager->flush();

            return $this->render('index.html.twig');
        }
    }
