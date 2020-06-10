<?php
namespace App\Controller;

use App\Entity\Test;
use App\Entity\Eventi;
use App\Entity\Progetti;
use App\Entity\User;
use App\Entity\Statistiche;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Doctrine\ORM\EntityManagerInterface;

    class eventController extends AbstractController{

        private $session;

        public function __construct(SessionInterface $session){
            $this->session = $session;
        }

        /**
        * @Route("/salvaProgetto", name="salvaProgetto")
        */
        public function salvaProgetto( Request $request ) {
            if( $request->get('data') && $this->session->get('login') ) {
                $data = $request->get('data');
                $data = json_decode($data);

                $progetto = new Progetti();

                $user = $this->getDoctrine()->getRepository(User::class)->findOneByUsername( $this->session->get('login') );

                $progetto->setFkIdUtente( $user );
                $progetto->setTitolo($data->title);
                $progetto->setDeadline($data->end);
               

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($progetto);
                $entityManager->flush();

                return new Response( "il caricamento del progetto è stato un successo!" );
            }
            else {
                return $this->redirectToRoute("index", array("errore" => "non sei loggato, oppure i dati non sono stati inseriti nel modo corretto"));
            }
        }


        /**
        * @Route("/salvaEvento", methods={"GET, POST"}, name="salvaEvento")
        */
        public function salvaEvento( Request $request ) {
            if( $request->get('data') && $this->session->get('login') ) {
                $data = $request->get('data');
                $data = json_decode($data);

                $evento = new Eventi();

                $user = $this->getDoctrine()->getRepository(User::class)->findOneByUsername( $this->session->get('login') );
                $evento->setFkIdUtente($user);

                if( !empty( $data->prog ) ) {
                    $progetto = $this->getDoctrine()->getRepository(Progetti::class)->findOneBy(['titolo' => $data->prog]);
                    $evento->setFkIdProgetto($progetto);
                }

                $evento->setStartDate($data->start);
                $evento->setEndDate($data->end);
                $evento->setTitolo($data->title);
                $evento->setPriorita($data->pri); //anche questa da passare nella request
                $evento->setCompletato(false); //false di default

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($evento);
                $entityManager->flush();

                return new Response( "success" );
            }
            else {
                return $this->redirectToRoute("index", array("errore" => "non sei loggato, oppure i dati non sono stati inseriti nel modo corretto"));
            }
        }

        /**
        * @Route("/eliminaEvento")
        */
        public function getNextId( Request $request )
        {
            $id = intval( $request->get('id') );

            $entityManager = $this->getDoctrine()->getManager();
            $evento = $entityManager->getRepository(Eventi::class)->find($id);

            if (!$evento) {
                return new Response( "evento con l'id di:". $id . " non è stato trovato" );
            }

            $entityManager->remove($evento);
            $entityManager->flush();

            if( $request->get('provenienza') == "calendario") {
                return new Response( "evento con l'id di:". $id . " è stato rimosso! e torno al calendario" );
            }
            elseif( $request->get('provenienza') == "eventList") {
                return $this->redirectToRoute("loadEventPage", array("username" => $this->session->get('login')));
            }
            else {
                return new Response( "non ho idea di come tu abbia fatto ad eliminare" );
            }
        }

        /**
        * @Route("/editEvent", methods={"POST"}, name="editEvent")
        */
        public function editEvent( Request $request ) {
            if( $request->get('id') && $this->session->get('login') ) {

                $entityManager = $this->getDoctrine()->getManager();
                $evento = $entityManager->getRepository(Eventi::class)->findOneById($request->get('id'));

                $user = $this->getDoctrine()->getRepository(User::class)->findOneByUsername( $this->session->get('login') );

                if($user->getId() == $evento->getFkIdUtente()->getId()){

                  $evento->setStartDate($request->get('startDate'));
                  $evento->setEndDate($request->get('endDate'));
                  $evento->setTitolo($request->get('titolo'));
                  $evento->setPriorita($request->get('priorita')); //anche questa da passare nella request

                  $entityManager->flush();

                  return $this->redirectToRoute("loadEventPage", array('username' => $this->session->get('login') ));

                } else {

                  return $this->redirectToRoute("index", array("errore" => "il login non corrisponde"));

                }
            }
            else {
                return $this->redirectToRoute("index", array("errore" => "non sei loggato, oppure i dati non sono stati inseriti nel modo corretto"));
            }
        }

        /**
        * @Route("/segnaComeCompletato/{id}", name="segnaComeCompletato")
        */
        public function segnaComeCompletato( $id )
        {
            $entityManager = $this->getDoctrine()->getManager();
            $evento = $entityManager->getRepository(Eventi::class)->find($id);

            if (!$evento) {
                return new Response( "evento con l'id di:". $id . " non è stato trovato" );
            }

            $startDate = date_create( $evento->getStartDate() );
            $endDate = date_create( $evento->getEndDate() );
            $durata =  date_diff($startDate, $endDate);
            
            $evento->setCompletato(1);
            $entityManager->flush();

            $statistica = new Statistiche();

            $statistica->setFkIdEvento( $id );
            $statistica->setTitoloEvento( $evento->getTitolo() );
            $statistica->setCompletionDate( date("Y-m-d") );
            $statistica->setDurata( $durata->d );

            $entityManager->persist($statistica);
            $entityManager->flush();

            return $this->redirectToRoute("loadEventPage", array("username" => $this->session->get('login')) );
        }

        /**
        * @Route("/segnaComeNonCompletato/{id}", name="segnaComeNonCompletato")
        */
        public function segnaComeNonCompletato( $id )
        {
            $entityManager = $this->getDoctrine()->getManager();
            $evento = $entityManager->getRepository(Eventi::class)->find($id);

            if (!$evento) {
                return new Response( "evento con l'id di:". $id . " non è stato trovato" );
            }

            $evento->setCompletato(0);
            $entityManager->flush();

            $statistica = $entityManager->getRepository(Statistiche::class)->findOneBy(['fkIdEvento' => $id]);
            $entityManager->remove($statistica);
            $entityManager->flush();


            return $this->redirectToRoute("loadEventPage", array("username" => $this->session->get('login')) );
        }

        /**
        * @Route("/cambiaDate", name="cambiaDate")
        */
        public function cambiaDate( Request $request )
        {
            $id = $request->get('id');
            $dataInizio = $request->get('dataInizio');
            $dataFine = $request->get('dataFine');

            if( $request->get('id') && $this->session->get('login') ) {

                $entityManager = $this->getDoctrine()->getManager();
                $evento = $entityManager->getRepository(Eventi::class)->findOneById( $id );

                $user = $this->getDoctrine()->getRepository(User::class)->findOneByUsername( $this->session->get('login') );

                if($user->getId() == $evento->getFkIdUtente()->getId()){

                  $evento->setStartDate($dataInizio);
                  $evento->setEndDate($dataFine);

                  $entityManager->flush();

                  return new Response( "è andato tutto bene nel cambiamento delle date tramite drag and drop" );

                } else {
                    return new Response( "non è stato trovato lo user nel cambiamento delle date tramite drag and drop" );
                }
            }
            else {
                return $this->redirectToRoute("index", array("errore" => "non sei loggato, oppure i dati non sono stati inseriti nel modo corretto"));
            }
        }
    }
