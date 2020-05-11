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

    class userController extends AbstractController{

        private $session;

        public function __construct(SessionInterface $session){

            $this->session = $session;

        }

        /**
        * @Route("/", methods={"GET"}, name="index")
        */
        public function isLogged(){

          if($this->checkLogin()){

            //prendo il colore
            //$userColorHex = $this->checkUserColor($this->session->get("login"));

            //pagine con user loggato
            return $this->render('index.html.twig', array('login' => $this->session->get("login"),'color' => $userColorHex));

          } else {
            //render not logged template

            return $this->render('landingPage.html.twig', array('login' => false));
          }

        }

        /**
        * @Route("/registrazione", methods={"POST"}, name="registrazione")
        */
        public function registra(Request $request) {
          if($request->get('username') && $request->get('password') && $request->get('mail') ) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = new User();
            
            $user->setUsername( $request->get('username') );
            $user->setMail( $request->get('mail') );
            $user->setPassword( $request->get('password') );

            // tell Doctrine you want to (eventually) save the Product
            $entityManager->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->render('landingPage.html.twig', array('registrazione' => 'avvenuta') );
          }
          else{
            return $this->render('landingPage.html.twig', array('registrazione' => 'NON avvenuta') );
          }
          
        }

        /**
        * @Route("/login", methods={"POST"}, name="login")
        */
        public function setLogin(Request $request) {
          if($this->session->get('login')){
            return $this->redirectToRoute("index");
          }
          
          if($request->get('userName',false) && $request->get('password',false)){
            $userName = $request->get('userName');
            $password = $request->get('password');

            $repository = $this->getDoctrine()->getRepository(User::class);

            $user = $repository->findOneByUsername($userName);

            if($user && $user->getUsername() == $userName && $user->getPassword() == md5($password)){
              //render logged page and set session login

              $fkUser = $user->getId();

              //creo l'oggetto sessionItem, lo inserisco, e salvo l'userName nella session dell'utente
              $userSession = new UserSession();
              $userSession->setSessId($this->session->getId());
              $userSession->setFkIdUser($user);

              $userSessionManager = $this->getDoctrine()->getManager();
              $userSessionManager->persist($userSession);
              $userSessionManager->flush();

              $this->session->set('login',$user->getUsername());

              //redirect to index
              return $this->redirectToRoute("index");

            } 
            else {
              //render not logged with error
              return $this->render('index.html.twig', ['error'=>"braaahh"]);
            }
          } 

         
        }

        //metodi privati
        private function checkLogin(){
         if($this->session->get('login',false)){
           $repository = $this->getDoctrine()->getRepository(UserSession::class);
           $userSession = $repository->findOneBysess_id($this->session->getId());

           if($userSession && $userSession->getUsername() == $this->session->get('login')){
             return true;
           } else {
             return false;
           }
         } else {
           return false;
         }
       }

    }