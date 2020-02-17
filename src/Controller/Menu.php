<?php

namespace App\Controller;

use App\Entity\Utils;
use App\Entity\Formulaire;
use App\Entity\Groups;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
class Menu extends AbstractController
{
    public function index(Request $request)
    {
        $O_Utils = NULL;
        $O_Formulaires = NULL;
        //call login et register function
        self::Login($request);
        self::Register($request);
        self::ForgotPass($request);
        //check si utils connecter
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('id')){
            $O_Utils = $repository->find($session->get('id'));
        //get all formulaire
        // a changer ajouter condition pour delegué
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            if($O_Utils->getAdmin() == 1){
                $O_Formulaires = $repository->findAll();
            }
            else{
                $O_Formulaires = $repository->findBy(array('N_ID_Utils_Crea' => $O_Utils->getId()));
            }
        }
        //call twig
        return $this->render('Menu.html.twig',['formulaires'=>$O_Formulaires,'utils'=>$O_Utils]);
    }
    public function Login(Request $request)
    {
        if($request->request->get('save') == 'login')
        {
            //get session active
            $session = $request->getSession();
            //get post data
            $T_Pseudo = $request->request->get('T_Pseudo');
            $T_Mdp = $request->request->get('T_Mdp');
            //call classe utils
            $repository = $this->getDoctrine()->getRepository(Utils::class);
            //check si utilisateur existe dans la bdd
            if($repository->findOneBy(['T_Pseudo' => $T_Pseudo]))
            {
                $O_Utils = $repository->findOneBy(['T_Pseudo' => $T_Pseudo]);
            }
            else{
                $O_Utils = $repository->findOneBy(['T_Email' => $T_Pseudo]);
            }
            if($O_Utils){
                //check password et set session utils
                if(password_verify($T_Mdp,$O_Utils->getMdp())){
                    $session->set('id', $O_Utils->getID());
                }
            }
        }
    }
    public function Register(Request $request)
    {
        if($request->request->get('save') == 'register')
        {
            //get session actif
            $session = $request->getSession();
            //get post data
            $T_Pseudo = $request->request->get('T_Pseudo');
            $T_Nom = $request->request->get('T_Nom');
            $T_Prenom = $request->request->get('T_Prenom');
            $T_Email = $request->request->get('T_Email');
            $T_Mdp = $request->request->get('T_Mdp');
            $T_Confirmed_Mdp = $request->request->get('T_Confirmed_Mdp');
            if($T_Mdp == $T_Confirmed_Mdp){
            //cree un nouvelle utilisateur
                $O_Utils = new Utils;
                //hash mdp
                $T_Hash = password_hash($T_Mdp ,PASSWORD_BCRYPT);
                $O_Utils->setNom($T_Nom);
                $O_Utils->setPseudo($T_Pseudo);
                $O_Utils->setPrenom($T_Prenom);
                $O_Utils->setEmail($T_Email);
                $O_Utils->setMdp($T_Hash);
                $O_Utils->setDateCrea(date('d-m-Y'));
                //1 = pas admin
                $O_Utils->setAdmin(1);
                //actualliser bdd
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Utils);
                $em->flush();
                //login
                $repository = $this->getDoctrine()->getRepository(Utils::class);
                $O_Utils = $repository->findOneBy(['T_Pseudo' => $T_Pseudo]);
                $session->set('id', $O_Utils->getID());
            }
        }
    }


    public function ForgotPass(Request $request)
    {
        if($request->request->get('save') == 'Forgot_Pass')
        {
            //get session actif
            $session = $request->getSession();
            //get post data
            $T_Pseudo = $request->request->get('T_Pseudo');
            $T_Old_Mdp = $request->request->get('T_Old_Mdp');
            $T_Mdp = $request->request->get('T_Mdp');
            $T_Confirmed_Mdp = $request->request->get('T_Confirmed_Mdp');
            //cree un nouvelle utilisateur
            $em = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(Utils::class);
            if($repository->findOneBy(['T_Pseudo' => $T_Pseudo]))
            {
                $O_Utils = $repository->findOneBy(['T_Pseudo' => $T_Pseudo]);
            }
            else{
                $O_Utils = $repository->findOneBy(['T_Email' => $T_Pseudo]);
            }
            if($O_Utils && $T_Mdp == $T_Confirmed_Mdp){
                //check password et set session utils
                if(password_verify($T_Old_Mdp,$O_Utils->getMdp())){
                    $T_Hash =  password_hash($T_Mdp ,PASSWORD_BCRYPT);
                    //actualliser bdd
                    //login
                    $O_Utils->setMdp($T_Hash);
                    $em->flush();
                    $session->set('id', $O_Utils->getID());
                }
            }
        }
    }
    public function Deconnexion(Request $request)
    {
        $request->getSession()->clear();
        return $this->redirectToRoute('index');
    }
}



//methode get fomulaire by association
/*$repository = $this->getDoctrine()->getRepository(Groups::class);
            $O_Formulaires = $repository->findAll();
            foreach($O_Formulaires as $A_formulaires){
                $tests = $A_formulaires->getForms();
                foreach($tests as $test){
                    dd($test->getIdForm()->getSlug());
                }
            }*/