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
            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneByUsername( 'koolkevin' );

            $repository = $this->getDoctrine()->getRepository(Progetti::class);
            $progetto = $repository->find(1);   //sarebbe da passare nei dati della request, lo setto arbitrariamente per adesso

            $data = $request->get('data');
            $dataUtilizzabile = json_encode();

            $evento = new Eventi();
            $evento->setFkIdUtente( $user ); 
            $evento->setFkIdUtente( $progetto ); 

            $evento->setStartDate( 's:5:"0/0/0";' ); 
            $evento->setTitolo( 'test' ); 
            $evento->setPriorita( 1 );  //anche questa da passare nella request

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evento);
            $entityManager->flush();

            return $this->render('landingPage.html.twig', array('login' => $data) );
        }

    }
