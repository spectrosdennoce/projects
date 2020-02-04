<?php
namespace App\Controller;

use App\Entity\Utils;
use App\Entity\Formulaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
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
    public function Register(Request $request)
    {
        if($request->request->has('save'))
        {
            $T_Titre = $request->request->get('T_Titre');
            $D_Crea = $request->request->get('D_Crea');
            $Utils = new Utils;
            $Utils->setNom($T_Titre);
            $Utils->setPseudo($T_Titre);
            $Utils->setPrenom($T_Titre);
            $Utils->setEmail($T_Titre);
            $Utils->setMdp($T_Titre);
            $Utils->setDateCrea($D_Crea);
            $Utils->setAdmin(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Utils);
            try {
                $em->flush();
            }
            catch(EntityNotFoundException $e){
                error_log($e->getMessage());
            }
        }
        return $this->render('Register.html.twig');
    }
    public function Add_Formulaire(Request $request)
    {
        $task = new Formulaire();
        $task->setTitre('Write a blog post');
        $task->setDateCrea(new \DateTime('tomorrow'));
        return $this->render('Add.Formulaire.html.twig');
    }
    public function Read_Formulaire()
    {
        return $this->render('Read.Formulaire.html.twig');
    }
}