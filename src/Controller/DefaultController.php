<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

    public function index(){
        return $this->render("base.html.twig");
    }

    public function hello(string $name){
        return $this->render("hello.html.twig", [
            'name' => $name]);
    }

}