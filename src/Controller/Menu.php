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
            $T_Pseudo = $request->request->get('T_Pseudo');
            $T_Nom = $request->request->get('T_Nom');
            $T_Prenom = $request->request->get('T_Prenom');
            $T_Email = $request->request->get('T_Email');
            $T_Mdp = $request->request->get('T_Mdp');
            $T_Confirmed_Mdp = $request->request->get('T_Confirmed_Mdp');


            $Utils = new Utils;
            $Utils->setNom($T_Nom);
            $Utils->setPseudo($T_Pseudo);
            $Utils->setPrenom($T_Prenom);
            $Utils->setEmail($T_Email);
            $Utils->setMdp($T_Titre);
            $Utils->setDateCrea(date ('d/m/Y'));
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

        $form = $this->createFormBuilder($task)
            ->add('T_Titre', TextType::class)
            ->add('D_Crea', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();
        // ...
        return $this->render('Add.Formulaire.html.twig');
    }
    public function Read_Formulaire()
    {
        return $this->render('Read.Formulaire.html.twig');
    }
}