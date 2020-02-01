<?php
namespace App\Controller;

use App\Entity\Utils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class Menu extends AbstractController
{
    public function index()
    {
        return $this->render('Menu.html.twig');
    }
    public function Login()
    {
        return $this->render('Login.html.twig');
    }
    public function Register()
    {
        return $this->render('Register.html.twig');
    }
    public function Add_Formulaire()
    {
        return $this->render('Add.Formulaire.html.twig');
    }
    public function Read_Formulaire()
    {
        return $this->render('Read.Formulaire.html.twig');
    }
}