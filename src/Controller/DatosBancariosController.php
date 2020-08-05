<?php


namespace App\Controller;


use App\Entity\DatosBancarios;
use App\Form\DatosBancariosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DatosBancariosController extends AbstractController
{
    private $session;
    private $entityManager;

    /**
     * @Required
     */
    public function setDependecies(SessionInterface $session, EntityManagerInterface $entityManager){
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route ("/datos", name="datos", methods={"GET","POST"})
     */
    public function GuardarDatosBancarios(Request $request){

        $client = $this->session->get("client", null);

        if($client == null){
            return $this->redirectToRoute("login");
        }
        dump($client);
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

        $DatosBancarios->setCliente($client);
        $client->setDatosBancarios($DatosBancarios);

        if(!$DatosBancariosForm->isValid()){
            return $this->render("datosBancarios.html.twig",[
                "datosBancariosForm" => $DatosBancariosForm->createView(),
                "error" => "El formulario no es valido"
            ]);
        }
    dump($DatosBancarios);
        try{
            $this->entityManager->persist($DatosBancarios);
            //$this->entityManager->persist($client);
            $this->entityManager->flush();
            //$this->entityManager->flush($client);
        } catch (\Exception $exception){
            dump($exception);
            return $this->render("datosBancarios.html.twig",[
                "datosBancariosForm" => $DatosBancariosForm->createView(),
                "error" => "Ha habido un error en la base de datos"
            ]);
        }

        $this->session->set("client", null);
        return $this->render("datosBancarios.html.twig",[
            "datosBancariosForm" => $DatosBancariosForm->createView(),
            "success" => "Los datos bancarios han sido guardados satisfactoriamente"
        ]);
    }

}