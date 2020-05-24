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

    class eventController extends AbstractController{

        private $session;

        public function __construct(SessionInterface $session){
            $this->session = $session;
        }

        /**
        * @Route("/salvaEvento", methods={"GET, POST"}, name="loadUserPage")
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

            return new Response( "evento con l'id di:". $id . " è stato rimosso!" );
        }
        
    }
