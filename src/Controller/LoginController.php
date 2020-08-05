<?php


namespace App\Controller;


use App\Entity\Cliente;
use App\Form\LoginType;
use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{

    private $clientRepository;
    private $session;

    /**
     * @Required
     */
    public function setDependencies(ClienteRepository $clientRepository, SessionInterface $session){
        $this->clientRepository = $clientRepository;
        $this->session = $session;
    }
    /**
     * @Route("/login", name="login", methods={"GET"})
     */
    public function login(){

        $client = $this->session->get("client", null);

        if($client !== null){
            return $this->redirectToRoute("datos");
        }

        $Client = new Cliente;

        $loginForm = $this->createForm(LoginType::class, $Client);

        return $this->render("login.html.twig",[
          "loginForm" => $loginForm->createView()
        ]);
    }


    /**
     * @Route("/login", name="loginHandle", methods={"POST"})
     */
    public function loginHandle(Request $request){

        $loginData = new Cliente;

        $loginForm = $this->createForm(LoginType::class, $loginData);

        $loginForm->handleRequest($request);

        if(!$loginForm->isSubmitted() || !$loginForm->isValid()){
            return $this->render("login.html.twig",[
                "loginForm" => $loginForm->createView(),
                "error" => "El formulario no es valido"
            ]);
        }

        $client = $this->clientRepository->findByNameEmail($loginData->getNombre(), $loginData->getEmail());

        if($client === null){
            return $this->render("login.html.twig",[
                "loginForm" => $loginForm->createView(),
                "error" => "El cliente no existe"
            ]);
        }

        $this->session->set("client", $client);

        return $this->redirectToRoute("datos");

    }
}