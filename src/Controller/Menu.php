<?php
// src/Controller/LuckyController.php
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
}