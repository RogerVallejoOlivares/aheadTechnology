<?php


namespace App\Controller;


use App\Entity\DatosBancarios;
use App\Form\DatosBancariosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller con Un solo metodo para el control del formulario (mostrar formulario, recoger datos del formulario)
 * TODO: Reformatar la duplicación de código al hacer render o redirect de ruta, crear función que tenga dos parametros(Route/TWIG, [$error])
 * TODO: Control de excepciones
 * Class DatosBancariosController
 * @package App\Controller
 */
class DatosBancariosController extends AbstractController
{
    private $session;
    private $entityManager;

    /**
     * Injection of dependecies, la session y el entityManager
     * @Required
     */
    public function setDependecies(SessionInterface $session, EntityManagerInterface $entityManager){
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    /**
     * Carga, procesamiento del formulario de datos bancarios, además de comprobar si el cliente está cargado en la Session
     * @Route ("/datos", name="datos", methods={"GET","POST"})
     */
    public function GuardarDatosBancarios(Request $request){

        /**
         * Recogida del client en Session y comprobación de que no sea nulo, si lo es redirige al formulario login
         */
        $client = $this->session->get("client", null);

        if($client == null){
            return $this->redirectToRoute("login");
        }

        $DatosBancarios = new DatosBancarios();

        if($client->getDatosBancarios() !== null){
            $DatosBancarios = $client->getDatosBancarios();
        }

        $DatosBancariosForm = $this->createForm(DatosBancariosType::class, $DatosBancarios);

        $DatosBancariosForm->handleRequest($request);

        if(!$DatosBancariosForm->isSubmitted()){
            return $this->render("datosBancarios.html.twig",[
                "datosBancariosForm" => $DatosBancariosForm->createView()
            ]);
        }

        /**
         * modificamos la entidad datos bancarios para crear la relación con el cliente que tenemos en la Session
         */
        $DatosBancarios->setCliente($client);
        $client->setDatosBancarios($DatosBancarios);

        /**
         * comprobación del formulario, sino lo es vuelve a cargar el formulario con un mensaje de error
         */
        if(!$DatosBancariosForm->isValid()){
            return $this->render("datosBancarios.html.twig",[
                "datosBancariosForm" => $DatosBancariosForm->createView(),
                "error" => "El formulario no es valido"
            ]);
        }

        try{
            /**
             * Seteamos la entity DatosBancarios con la relación del cliente
             * Con el flush Doctrine se encarga de comprobar los datos y guardarlos en la base de datos
             * Si no existen datos bancarios relacionados con ese cliente hará un insert si ya existen hará un update
             * Si hay algun error en la base de datos el catch recibira la exception (ahora mismo cualquier exception)
             */
            $this->entityManager->merge($DatosBancarios);
            $this->entityManager->flush();
        } catch (\Exception $exception){
            dump($exception);
            return $this->render("datosBancarios.html.twig",[
                "datosBancariosForm" => $DatosBancariosForm->createView(),
                "error" => "Ha habido un error en la base de datos"
            ]);
        }

        /**
         * si ha ido bien el seteamos el client a null para poder hacer el login con otro cliente o con el mismo otra vez
         */
        $this->session->set("client", null);
        return $this->render("datosBancarios.html.twig",[
            "datosBancariosForm" => $DatosBancariosForm->createView(),
            "success" => "Los datos bancarios han sido guardados satisfactoriamente"
        ]);
    }

}