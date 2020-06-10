<?php

namespace App\Controller;

use App\Entity\Test;
use App\Entity\Eventi;
use App\Entity\Progetti;
use App\Entity\User;
use App\Entity\Priorita;
use App\Entity\Statistiche;

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
        * @Route("/test")
        */
        public function test( \Swift_Mailer $mailer ){
          /*$message = (new Swift_Message()) //non capisco tanto
            ->setSubject('subject')
            ->setFrom(['kevinkoltraka1011@gmail.com' => 'Mike Hoxlong'])
            ->setTo(['akile1011@gmail.come' => 'Mike Litoris'])
            ->setBody('Here is the message itself')
            ->addPart('<q>Here is the message itself</q>', 'text/html');

          $mailer->send($message);*/

          $repository = $this->getDoctrine()->getRepository(Statistiche::class);
          $statistiche = $repository->find(4);
          //$eventi = $user->getEventi();

          /*$statistica = new Statistiche();
          $statistica->setTitoloEvento('Keyboard');
          $statistica->setCompletionDate("oggi-oggi-oggi");
          $statistica->setDurata( 4 );
          $statistica->setFkIdEvento( 4 );
          
          $entityManager->persist($statistica);
          $entityManager->flush();*/

          return new Response( $statistiche->getTitoloEvento() );
        }

        /**
        * @Route("/home/{username}", name="home")
        */
        public function home($username){
          $repository = $this->getDoctrine()->getRepository(User::class);
          $user = $repository->findOneByUsername($username);
          $eventi = $user->getEventi();

          $oggi =  date_create( date("Y-m-d") );
        
          $eventiUrgenti = "";

          foreach ($eventi as $evento) {
            $repository = $this->getDoctrine()->getRepository(Priorita::class);
            $priorita = $repository->findOneById($evento->getPriorita());
            $colore = $priorita->getColore();

            $endDate = date_create( $evento->getEndDate() );

            $differenza = date_diff($oggi, $endDate);

            if( $evento->getCompletato() != 1 && $differenza->invert == 0 && $differenza->d < 7 ) {   //magari facciamo anche un opzione per determinare l'intervallo
              switch( $evento->getPriorita() ) {
                case 1: //il coloro lo dovrei prendere facendo una query sulla tabella priorita
                 
                  $eventiUrgenti .= '<div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2" style="border-left-color:'. $colore .' !important">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'. $evento->getTitolo() .'</div>
                                                    <div class="h5 mb-0 text-gray-800">dovrei mettere un campo descrizione nel db in effetti :/</div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                  break;
                
                case 2:
                  $eventiUrgenti .= '<div class="col-xl-4 col-md-6 mb-4">
                                      <div class="card border-left-info shadow h-100 py-2" style="border-left-color:'. $colore .' !important">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'. $evento->getTitolo() .'</div>
                                                    <div class="h5 mb-0 text-gray-800">dovrei mettere un campo descrizione nel db in effetti :/</div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                  break;

                case 3:
                  $eventiUrgenti .= '<div class="col-xl-4 col-md-6 mb-4">
                                      <div class="card border-left-info shadow h-100 py-2" style="border-left-color:'. $colore .' !important">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'. $evento->getTitolo() .'</div>
                                                    <div class="h5 mb-0 text-gray-800">dovrei mettere un campo descrizione nel db in effetti :/</div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                  break;

                case 4:
                  $eventiUrgenti .= '<div class="col-xl-4 col-md-6 mb-4">
                                      <div class="card border-left-info shadow h-100 py-2" style="border-left-color:'. $colore .' !important">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'. $evento->getTitolo() .'</div>
                                                    <div class="h5 mb-0 text-gray-800">dovrei mettere un campo descrizione nel db in effetti :/</div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                  break;

                case 5:
                  $eventiUrgenti .= '<div class="col-xl-4 col-md-6 mb-4">
                                      <div class="card border-left-info shadow h-100 py-2" style="border-left-color:'. $colore .' !important">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'. $evento->getTitolo() .'</div>
                                                    <div class="h5 mb-0 text-gray-800">dovrei mettere un campo descrizione nel db in effetti :/</div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                  break;
              }
            }
          }
          
          return $this->render('index.html.twig', array('login' => $username, 'eventiUrgenti' => $eventiUrgenti, "sidebar" => array("calendar" => false, "eventList" => false)/*,'color' => $userColorHex*/));
        }


        /**
        * @Route("/calendar/{username}", methods={"GET"}, name="loadUserPage")
        */
        public function generaPaginaUtente($username){
          if($this->session->get('login')) {
            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneBy(['username' => $username]);
            $eventi = $user->getEventi();  //fa da solo
            $progetti = $user->getProgettis();

            $listaEventi = "";
            $listaProgetti = "";

            foreach($progetti as $progetto) {
              //return new Response( $progetto->getTitolo() );
              
              $listaProgetti .= ' <div class="row justify-content-center mb-3">
                                      <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'. $progetto->getTitolo() .'</div>
                                                    <div class="h5 mb-0 text-gray-800">'. $progetto->getDeadline() .'</div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                  </div>';
            }

            foreach ($eventi as $evento) {
              $repository = $this->getDoctrine()->getRepository(Priorita::class);
              $priorita = $repository->findOneById($evento->getPriorita());
              $colore = $priorita->getColore();
              
              if( $evento->getCompletato() != 1 ) {   //gli eventi completati non li carico
                $listaEventi .= '{ 
                  "id": '.$evento->getId().',
                  "title": "'.$evento->getTitolo().'",
                  "start": "'.$evento->getStartDate().'",
                  "end":  "'.$evento->getEndDate().'",
                  "backgroundColor": "'. $colore .'"
                  },';
              }
              
            }

            return $this->render('calendario.html.twig', array('login' => $username, "sidebar" => array("calendar" => true, "eventList" => false), "listaEventi" => $listaEventi, "listaProgetti" => $listaProgetti ) );
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
            //cancello gli eventi segnati come completati da più di un giorno
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneByUsername($username);
            $eventi = $user->getEventi();  //fa da solo

            $oggi =  date_create( date("Y-m-d") );
          
            $bruh = "";

            foreach ($eventi as $evento) {    
              $statistica = $entityManager->getRepository(Statistiche::class)->findOneBy(['fkIdEvento' => $evento->getId()]); 

              if ( $statistica ) {
                $endDate = date_create( $statistica->getCompletionDate() );
                $differenza = date_diff($oggi, $endDate);

                if( $differenza->d > 0 ) {
                  $entityManager->remove($evento);
                  $entityManager->flush();
                }
                
              }
            }

            //la merda di roffia
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
