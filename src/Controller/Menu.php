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
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $O_Utils = NULL;
        $O_Formulaires = NULL;
        //call login et register function
        self::Login($request);
        self::Register($request);
        self::oublipass($request);
        //check si utils connecter
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $O_Groups = $O_Utils->getGroups();
            //get all formulaire
            // a changer ajouter condition pour delegué
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            if($O_Utils->getAdmin() == 1)
            {
                $O_Formulaires = $repository->findBy(array('B_Visible' => 1 ));
            }
            else{
                //get all formulaire by groups
                foreach ($O_Groups as $O_Group)
                {
                    $O_Forms = $O_Group->getIdGroups()->getForms();
                    if($O_Group->getDelegue()){
                        foreach ($O_Forms as $O_Form)
                        {
                            if($O_Form->getIdForm()->getVisible()==1){
                                $O_Formulaires[] = $O_Form->getIdForm();
                            }
                        }
                    }
                }
            }
        }
        //call twig
        return $this->render('Menu.html.twig',['formulaires'=>$O_Formulaires,'utils'=>$O_Utils]);
    }
    
    public function Check_Users(Request $request)
    {
        $T_Value = $request->request->get('Value');
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        if($repository->findOneBy(['T_Pseudo' => $T_Value]))
        {
            return new Response('{"Etat":"KO","Name":"pseudo","Error":"Pseudo Déjà utiliser!"}', 403 , array('Content-Type' => 'application/json'));
        }
        else if($repository->findOneBy(['T_Email' => $T_Value]))
        {
            return new Response('{"Etat":"KO","Name":"email","Error":"Email Déjà utiliser!"}', 403 , array('Content-Type' => 'application/json'));
        }
        return new Response('OK', 200 , array('Content-Type' => 'text/plain'));

    }
    public function Login(Request $request)
    {
        //get session active
        $session = $request->getSession();
        //get post data
        $T_Pseudo = $request->request->get('T_Pseudo');
        $T_Mdp = $request->request->get('T_Mdp');
        //call classe utils
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $O_Utils = null;
        //check si utilisateur existe dans la bdd
            if($repository->findOneBy(['T_Pseudo' => $T_Pseudo]))
            {
                $O_Utils = $repository->findOneBy(['T_Pseudo' => $T_Pseudo]);
            }
            else if($repository->findOneBy(['T_Email' => $T_Pseudo]))
            {
                $O_Utils = $repository->findOneBy(['T_Email' => $T_Pseudo]);
            }
        if($O_Utils){
            //check password et set session utils
            if(password_verify($T_Mdp,$O_Utils->getMdp())){
                $session->set('utils', $O_Utils);
                return new Response('OK', 200 , array('Content-Type' => 'text/plain'));
            }
        }
        return new Response('{"Etat":"KO","Name":"login","Error":"Identifiant incorrect!"}', 403 , array('Content-Type' => 'application/json'));
    }
    
    // un admin qui dois enregistrer un éléves 
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
                //Génére le token et l'enregistre
                $O_Utils ->setActivationToken(md5(uniqid()));
                //actualliser bdd
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Utils);
                $em->flush();
                //login
                $repository = $this->getDoctrine()->getRepository(Utils::class);
                $O_Utils = $repository->findOneBy(['T_Pseudo' => $T_Pseudo]);
                $session->set('utils', $O_Utils);

                //rajout pout mail 
                $message = (new \Swift_Message('Bienvenue'))
                // On attribue l'expéditeur
                ->setFrom('forms.projet.bts@gmail.com')
                // On attribue le destinataire
                ->setTo($T_Email->getEmail())
                // On crée le texte avec la vue
                ->setBody(
                    $this->renderView(
                        'Utilisateurs/activation.html.twig', ['token' => $T_Email->getActivationToken()]
                    ),
                    'text/html'
                );
                
                $mailer->send($message);

            }
        }
    }
    
    //Faire la route d'activation
    public function activation ($token, Utils $T_Email)
    {
        //on recherche si un utilisateur existe dans la base de données 
        $O_Utils= $T_Email->findOneBy(['activation_token' => $token]);

        if(!$O_Utils)
        {
            //error
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }
        // On supprime le token 
        $O_Utils->setActivationToken(null);
        $em = $this->getDoctrine()->getManager();
        $em->persist($O_Utils);
        $em->flush();

        // On génère un message
        $this->addFlash('message', 'Utilisateur activé avec succès');
      
        return $this->redirectToRoute('index');
    }

    public function oublipass(Request $request)
    {
        //formulaire d'oublie de mdp 
        //si le formulaire est valide ou recupere l'email sinon en renvoie un message d'erreur
        /*
        if ($O_Forms->isSubmitted() && $O_Forms->isValid()) {
            // On récupère les données
            $O_Utils = $O_Forms->getData();
            // On cherche un utilisateur ayant cet e-mail
            $O_Utils = $repository->findOneBy(['T_Email' => $T_Email]);
        
        // Si l'utilisateur n'existe pas
        if ($T_Email === null) {
            // On envoie une alerte disant que l'adresse e-mail est inconnue
            $this->addFlash('danger', 'Cette adresse e-mail est inconnue');
            return $this->redirectToRoute('index');
     }
     */

        // On génère un token qui permetra d'avoir le lien "en absolue dans le twig" 
        $token = $tokenGenerator->generateToken();

        // écrire le token en base de données
        try{
            $O_Utils->setResetToken($token);
            $em = $this->getDoctrine()->getManager();
            $em->persist($O_Utils);
            $em->flush();
        } catch (\Exception $e) {
            $this->addFlash('warning', $e->getMessage());
            return $this->redirectToRoute('index');
        }

        // On génère l'URL de réinitialisation de mot de passe
        $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

        $message = (new \Swift_Message('Mot de passe oublié'))
            ->setFrom('forms.projet.bts@gmail.com')
            ->setTo($T_Email->getEmail())
            ->setBody(
                //prvisoire
                'Utilisateurs/ChangePassword.html.twig',
            )
        ;

        $mailer->send($message);

        // msg de confirmation
        $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');
        return $this->redirectToRoute('index');
    }

        //return $this->render('Utilisateurs/ChangePassword.html.twig',['emailForm' => $form->createView()]);
    //}

   /* //a supprimer ?? 
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
*/
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



           // mail
       /*$message = (new \Swift_Message('Hello Email'))
        ->setFrom('forms.projet.bts@gmail.com')
        ->setTo('amelie.guerin@formation-technologique.Fr')
        ->setBody(
            $this->renderView(
                'Utilisateur/mail.html.twig',
            ),
            'text/html'
        )
    ;

    $mailer->send($message);

*/