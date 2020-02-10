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
    public function index(Request $request)
    {
        self::Login($request);
        self::Register($request);
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $O_Utils = $repository->findAll();
        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        $O_Formulaires = $repository->findAll();
        return $this->render('Menu.html.twig',['formulaires'=>$O_Formulaires,'utils'=>$O_Utils]);
    }
    public function Login(Request $request)
    {
        if($request->request->get('save') == 'login')
        {
            $T_Pseudo = $request->request->get('T_Pseudo');
            $T_Mdp = $request->request->get('T_Mdp');
            $repository = $this->getDoctrine()->getRepository(Utils::class);
            if($O_Formulaires = $repository->findOneBy(['T_Pseudo' => $T_Pseudo])){
                dd($O_Formulaires);
            }
        }
    }
    public function Register(Request $request)
    {
        if($request->request->get('save') == 'register')
        {
            $T_Pseudo = $request->request->get('T_Pseudo');
            $T_Nom = $request->request->get('T_Nom');
            $T_Prenom = $request->request->get('T_Prenom');
            $T_Email = $request->request->get('T_Email');
            $T_Mdp = $request->request->get('T_Mdp');
            $T_Confirmed_Mdp = $request->request->get('T_Confirmed_Mdp');
            $O_Utils = new Utils;
            $T_Hash =  password_hash($T_Mdp ,PASSWORD_BCRYPT);
            $O_Utils->setNom($T_Nom);
            $O_Utils->setPseudo($T_Pseudo);
            $O_Utils->setPrenom($T_Prenom);
            $O_Utils->setEmail($T_Email);
            $O_Utils->setMdp($T_Hash);
            $O_Utils->setDateCrea(date('d/m/Y'));
            $O_Utils->setAdmin(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($O_Utils);
            $em->flush();
        }
    }
}