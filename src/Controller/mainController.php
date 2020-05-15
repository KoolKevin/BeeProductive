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
            $evento->setTitolo("prova2");
            $evento->setPriorita(1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evento);
            $entityManager->flush();

            return $this->render('index.html.twig');
        }

        /**
        * @Route("/profile/calendar/{username}", methods={"GET"}, name="loadUserPage")
        */
        public function generaPaginaUtente($username){
          $repository = $this->getDoctrine()->getRepository(User::class);
          $user = $repository->findOneBy(['username' => $username]);
          $eventi = $user->getEventi();  //fa da solo

          return $this->render('calendario.html.twig', array('login' => $username, "sidebar" => array("calendar" => true, "eventList" => false), "eventi" => $eventi ) );
        }

        /**
        * @Route("/profile/eventList/{username}", methods={"GET"}, name="loadUserPage")
        */

        public function generaListaEventi($username){
          $repository = $this->getDoctrine()->getRepository(User::class);
          $user = $repository->findOneBy(['username' => $username]);
          $eventi = $user->getEventi();  //fa da solo. ah grazie, se fa da solo allora io non faccio niente.

          return $this->render('eventList.html.twig', array('login' => $username, "sidebar" => array("calendar" => false, "eventList" => true), "eventi" => $eventi ) );
        }


        //metodi privati
        private function checkLogin(){
         if($this->session->get('login')){
           /*$repository = $this->getDoctrine()->getRepository(UserSession::class);
           $userSession = $repository->findOneBysess_id($this->session->getId());*/

           /*if($userSession && $userSession->getUsername() == $this->session->get('login')){
             return true;
           } else {
             return false;
           }*/
           return true;
         }
         else {
           return false;
         }
       }

    }
