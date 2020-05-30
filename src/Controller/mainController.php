<?php

namespace App\Controller;

use App\Entity\Test;
use App\Entity\Eventi;
use App\Entity\Progetti;
use App\Entity\User;
use App\Entity\Priorita;

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
            $eventiAttivi = $repository->getEventiAttiviUtenteConPriorita($user->getId());
            $eventiCompletati = $repository->getEventiCompletatiUtenteConPriorita($user->getId());

            $repository = $this->getDoctrine()->getRepository(Priorita::class);
            $priorita = $repository->getAllPriorita();

            $eventiAttiviSorted = [];
            $eventiAttiviSorted[1] = [];

            $eventiCompletatiSorted = [];
            $eventiCompletatiSorted[1] = [];

            $this->logger->debug(json_encode($priorita));


            //$this->logger->debug(json_encode($eventi[0]));


            foreach ($priorita as $id => $prio) {
              $eventiAttiviSorted[$id+1] = [];
              $eventiCompletatiSorted[$id+1] = [];
            }

            $i = 1;

            for($fuckyou = 0 ; $fuckyou < count($eventiAttivi) ;) {
              $this->logger->debug("attivo".$eventiAttivi[$fuckyou]["priorita"]);
              if($eventiAttivi[$fuckyou]["priorita"] == $i){
                array_push($eventiAttiviSorted[$i], $eventiAttivi[$fuckyou]);
                $fuckyou++;
              } else {
                $i++;
              }
            }

            $i = 1;

            for($fuckyou = 0 ; $fuckyou < count($eventiCompletati) ;) {
              $this->logger->debug("comletato".$eventiCompletati[$fuckyou]["priorita"]);
              if($eventiCompletati[$fuckyou]["priorita"] == $i){
                array_push($eventiCompletatiSorted[$i], $eventiCompletati[$fuckyou]);
                $fuckyou++;
              } else {
                $i++;
              }
            }

            //$this->logger->debug(json_encode($eventiPrio[1]["prio"]));

            $this->logger->critical("bruh");

            return $this->render('eventList.html.twig', array('login' => $username, "sidebar" => array("calendar" => false, "eventList" => true), "eventiAttivi" => $eventiAttiviSorted, "eventiCompletati" => $eventiCompletatiSorted, "prio" => $priorita ) );
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
