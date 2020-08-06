<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\LoginType;
use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller con dos methodos separados para el control del formulario (mostrar formulario, recoger datos del formulario)
 * TODO: Reformatar la duplicación de código al hacer render o redirect de ruta, crear función que tenga dos parametros(Route/TWIG, [$error])
 * TODO: Control de excepciones
 * Class LoginController
 * @package App\Controller
 */
class LoginController extends AbstractController
{

    private $clientRepository;
    private $session;

    /**
     * Injection of dependencies, el repositorio del cliente para el control de BBDD y la session
     * TODO: ¿Extraer todo en services?
     * @Required
     */
    public function setDependencies(ClienteRepository $clientRepository, SessionInterface $session){
        $this->clientRepository = $clientRepository;
        $this->session = $session;
    }
    /**
     * Carga del formulario del login y comprobación de Session para evitar el "relogin" del usuario
     * @Route("/login", name="login", methods={"GET"})
     */
    public function login(){

        /** Si ya hay un Cliente guardado en Session se redirigirá al formulario de datos bancarios
         */
        $client = $this->session->get("client", null);

        if($client !== null){
            return $this->redirectToRoute("datos");
        }

        $Client = new Cliente;

        $loginForm = $this->createForm(LoginType::class, $Client);

        /**  render de la vista con el formulario del login
         */
        return $this->render("login.html.twig",[
          "loginForm" => $loginForm->createView()
        ]);
    }


    /**
     * Procesamiento del formulario
     * @Route("/login", name="loginHandle", methods={"POST"})
     */
    public function loginHandle(Request $request){

        $loginData = new Cliente;

        $loginForm = $this->createForm(LoginType::class, $loginData);

        $loginForm->handleRequest($request);

        /**
         * Si el formulario esta vacío o falta algún campo vuelve a cargar el formulario de login con un mensaje de error genérico
         * TODO: Control de excepciones, mensajes de error personalizados por ejemplo; el campo nombre está vacío o longitud máxima alcanzada...
         */
        if(!$loginForm->isSubmitted() || !$loginForm->isValid()){
            return $this->render("login.html.twig",[
                "loginForm" => $loginForm->createView(),
                "error" => "El formulario no es valido"
            ]);
        }

        /**
         * Call al repositorio para buscar el cliente, esto nos devuelve la entidad cliente o un null
         */
        $client = $this->clientRepository->findByNameEmail($loginData->getNombre(), $loginData->getEmail());

        /**
         * Comprobación por si el cliente no existe
         */
        if($client === null){
            return $this->render("login.html.twig",[
                "loginForm" => $loginForm->createView(),
                "error" => "El cliente no existe"
            ]);
        }

        /**
         * Añadimos el cliente a la Session, para evitar "relogin"
         */
        $this->session->set("client", $client);

        return $this->redirectToRoute("datos");

    }
}