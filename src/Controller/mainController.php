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

use Psr\Log\LoggerInterface;

    class mainController extends AbstractController{

        private $session;

        private $logger;

        public function __construct(SessionInterface $session, LoggerInterface $logger){

            $this->session = $session;

            $this->logger = $logger;

        }

        /**
        * @Route("/calendar/{username}", methods={"GET"}, name="loadUserPage")
        */
        public function generaPaginaUtente($username){
          if($this->session->get('login')) {
            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneBy(['username' => $username]);
            $eventi = $user->getEventi();  //fa da solo

            return $this->render('calendario.html.twig', array('login' => $username, "sidebar" => array("calendar" => true, "eventList" => false), "eventi" => $eventi ) );
          }
          else {
            return $this->redirectToRoute("index", array("errore" => "devi essere loggato per accedere a questa pagina"));
          }

        }

        /**
        * @Route("/eventList/{username}", methods={"GET"}, name="loadEventPage")
        */
        public function generaListaEventi($username){
          if($this->session->get('login')) {
            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneBy(['username' => $username]);
            $eventi = $repository->getEventiUtenteConPriorita($user->getId());

            $eventiPrio = [];
            $i = 1;
            $eventiPrio[1] = [];

            $this->logger->debug(json_encode($eventi[0]));

            for($fuckyou = 0 ; $fuckyou < count($eventi) ;) {
              $this->logger->debug($eventi[$fuckyou]["priorita"]);
              if($eventi[$fuckyou]["priorita"] == $i){
                array_push($eventiPrio[$i], $eventi[$fuckyou]);
                $fuckyou++;
              } else {
                $i++;
                $eventiPrio[$i] = [];
              }
            }

            //$this->logger->debug(json_encode($eventiPrio[1]["prio"]));

            $this->logger->critical("bruh");

            return $this->render('eventList.html.twig', array('login' => $username, "sidebar" => array("calendar" => false, "eventList" => true), "eventi" => $eventiPrio ) );
          }
          else {
            return $this->redirectToRoute("index", array("errore" => "devi essere loggato per accedere a questa pagina"));
          }
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
