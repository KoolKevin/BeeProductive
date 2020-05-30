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
            //$userColorHex = $this->checkUserColor($this->session->get('login'));

            //pagine con user loggato
            return $this->redirectToRoute("home", array('username' =>  $this->session->get('login') ));
          } 
          else {
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
            $user->setPassword( md5($request->get('password')) );

            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->session->set('login', $user->getUsername());

            return $this->redirectToRoute("index");
          }
          else{
            return $this->render('landingPage.html.twig', array('login' => false) );
          }
        }

        /**
        * @Route("/login", methods={"POST"}, name="login")
        */
        public function setLogin(Request $request) {
          if($this->session->get('login')){
            return $this->render('index.html.twig', array('login' => $this->session->get("login"), "sidebar" => array("calendar" => false, "eventList" => false)/*,'color' => $userColorHex*/));
          }

          if($request->get('username',false) && $request->get('password',false)){
            $userName = $request->get('username');
            $password = $request->get('password');

            $repository = $this->getDoctrine()->getRepository(User::class);

            $user = $repository->findOneBy(['username' => $userName]);

            if($user && $user->getUsername() == $userName && $user->getPassword() == md5($password)){
              //render logged page and set session login

              //creo l'oggetto sessionItem, lo inserisco, e salvo l'username nella session dell'utente
              /*$userSession = new UserSession();
              $userSession->setSessId($this->session->getId());
              $userSession->setFkIdUser($user);
              $userSessionManager = $this->getDoctrine()->getManager();
              $userSessionManager->persist($userSession);
              $userSessionManager->flush();*/

              $this->session->set('login',$user->getUsername());

              //redirect to index
              return $this->redirectToRoute("index", array('username' => $user->getUsername()));
            }
            else {
              //render not logged with error
              return $this->render('landingPage.html.twig', array('login' => false) );
            }
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
