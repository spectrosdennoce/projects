<?php

namespace App\Controller;

use App\Entity\Utils;
use App\Entity\Formulaire;
use App\Entity\Ligne_Formulaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
class Forms_Editing extends AbstractController
{
    public function Creation(Request $request)
    {
        //create formulaire
        $O_Forms = new Formulaire;
        $O_Forms_Ligne = new Ligne_Formulaire;
        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        //call unique slug
        $T_Slug = $this->getRandString(15);
        while($repository->findOneBy(['T_Slug' => $T_Slug])){
            $T_Slug = $this->getRandString(15);
        }
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        //get session actif
        $session = $request->getSession();
        //set createur date slug
        $O_Utils = $repository->find($session->get('utils'));
        $O_Forms->setIdUtilsCrea($O_Utils);
        $O_Forms->setDateCrea(date('d-m-Y'));
        $O_Forms->setSlug($T_Slug);
        $O_Forms->setVisible(1);
        $O_Forms_Ligne->setDateCrea(date('d-m-Y'));
        $O_Forms_Ligne->setVisible(1);
        $O_Forms_Ligne->setObli(0);
        $O_Forms_Ligne->setType(1);
        $O_Forms_Ligne->setSelect(1);
        $O_Forms_Ligne->setIdUtilsCrea($O_Utils);
        $O_Forms_Ligne->setForms($O_Forms);

        //envoyer en bdd avec un try catch exeption (a voir interer)
        $em = $this->getDoctrine()->getManager();
        $em->persist($O_Forms);
        $em->persist($O_Forms_Ligne);
        try {
            $em->flush();
        }
        catch(EntityNotFoundException $e){
            error_log($e->getMessage());
        }
        //redirige vers Menu.html.twig
        return $this->redirectToRoute('index');
    }
    public function Delete_Ligne(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            if($O_Utils->getAdmin() == 1){
                $repository = $this->getDoctrine()->getRepository(Ligne_Formulaire::class);
                $O_Forms_Ligne = $repository->findOneBy(['ID' => $request->request->get('id')]);
                $O_Forms = $O_Forms_Ligne->getForms();
                $em = $this->getDoctrine()->getManager();
                $em->remove($O_Forms_Ligne);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }

                $O_Ligne = $O_Forms->getLigne();
                return $this->render('Formulaire/ligne.html.twig',['formulaires'=>$O_Forms,'Lignes'=>$O_Ligne,'utils'=>$O_Utils]);
            }
            else
            {
                return new Response('KO PAS LE DROIT', 403 , array('Content-Type' => 'text/html'));
            }
        }
        else
        {
            return $this->redirectToRoute('index');
        }
    }
    public function Create_Ligne(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            if($O_Utils->getAdmin() == 1){
                $O_Forms_Ligne = new Ligne_Formulaire;
                $repository = $this->getDoctrine()->getRepository(Formulaire::class);
                $O_Forms = $repository->findOneBy(['ID' => $request->request->get('id')]);
                $O_Forms_Ligne->setDateCrea(date('d-m-Y'));
                $O_Forms_Ligne->setVisible(1);
                $O_Forms_Ligne->setIdUtilsCrea($O_Utils);
                $O_Forms_Ligne->setObli(0);
                $O_Forms_Ligne->setType(1);
                $O_Forms_Ligne->setSelect(1);
                $O_Forms_Ligne->setForms($O_Forms);
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Forms_Ligne);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                $O_Ligne = $O_Forms->getLigne();
                return $this->render('Formulaire/ligne.html.twig',['formulaires'=>$O_Forms,'Lignes'=>$O_Ligne,'utils'=>$O_Utils]);
            }
            else
            {
                return new Response('KO PAS LE DROIT', 403 , array('Content-Type' => 'text/html'));
            }
        }
        else
        {
            return $this->redirectToRoute('index');
        }
    }
    public function Change_Ligne(Request $request)
    {
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $session->get('utils');
            if($O_Utils->getAdmin() == 1){
                $N_Id_Forms = $request->request->get('Id_Forms');
                $N_Id = $request->request->get('Id');
                $T_Name = $request->request->get('Name');
                $Value = $request->request->get('Value');
                $repository = $this->getDoctrine()->getRepository(Ligne_Formulaire::class);
                $O_Forms_Ligne = $repository->findOneBy(['ID' => $N_Id]);
                switch($T_Name){
                    case "T_Titre":
                        $O_Forms_Ligne->setTitre($Value);
                    break;
                    case "B_Obli":
                        $O_Forms_Ligne->setObli($Value);
                    break;
                    case "N_Type":
                        $O_Forms_Ligne->setType($Value);
                    break;
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Forms_Ligne);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                $repository = $this->getDoctrine()->getRepository(Formulaire::class);
                $O_Forms = $repository->findOneBy(['ID' => $N_Id_Forms]);
                $O_Ligne = $O_Forms->getLigne();
                return $this->render('Formulaire/ligne.html.twig',['formulaires'=>$O_Forms,'Lignes'=>$O_Ligne,'utils'=>$O_Utils]);
            }
            else
            {
                return new Response('KO PAS LE DROIT', 403 , array('Content-Type' => 'text/html'));
            }
        }
        else
        {
            return $this->redirectToRoute('index');
        }
    }
    public function Read(Request $request,string $T_Slug)
    {
        $O_Utils = null;
        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        $O_Formulaire = $repository->findOneBy(['T_Slug' => $T_Slug]);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $session->get('utils');
        }
        else
        {
            return $this->redirectToRoute('index');
        }
        $O_Ligne = $O_Formulaire->getLigne();
        return $this->render('\Formulaire\Modify.Formulaire.html.twig',['formulaire'=>$O_Formulaire,'Lignes'=>$O_Ligne,'utils'=>$O_Utils]);
    }
    function getRandString($n) { 
        //generer slug unique
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
        //enleve x lettre aleatoir dans characters
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        return $randomString; 
    } 
}
?>
