<?php

namespace App\Controller;

use App\Entity\Assoc_Formulaires_Groups;
use App\Entity\Utils;
use App\Entity\Formulaire;
use App\Entity\Groups;
use App\Entity\Ligne_Formulaire;
use App\Entity\InLigne_Formulaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
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
        $O_Forms->setValide(0);
        $O_Forms_Ligne->setDateCrea(date('d-m-Y'));
        $O_Forms_Ligne->setObli(0);
        $O_Forms_Ligne->setType(1);
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
        return $this->redirect("/Formulaire/Read/$T_Slug");
    }
    public function Save_Img(Request $request){
        
        $T_Slug = $request->request->get('T_Slug');
        $data = $request->request->get('base64');
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        
        $destination_img = 'destination .jpg';
        try {
            $file = new Filesystem();
            $file->mkdir($_SERVER['DOCUMENT_ROOT']."/img", 0755);
            $file->remove($_SERVER['DOCUMENT_ROOT'].'/img/'.$T_Slug.".png");
            $file->appendToFile($_SERVER['DOCUMENT_ROOT'].'/img/'.$T_Slug.".png", $data);
        }
        catch(EntityNotFoundException $e){
            return new Response('KO', 403 , array('Content-Type' => 'text/html'));
        }
        return new Response('OK', 200 , array('Content-Type' => 'text/html'));
    }
    public function Change_Forms(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $Value = $request->request->get('Value');
                $O_Forms->setTitre($Value);
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Forms);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                return new Response('OK', 200 , array('Content-Type' => 'text/html'));
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
    public function Delete_Forms(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $em = $this->getDoctrine()->getManager();
                $O_Forms->setDateDele(date('d-m-Y'));
                $O_Forms->setVisible(0);
                $em->persist($O_Forms);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                return new Response('OK', 200 , array('Content-Type' => 'text/html'));
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
    public function Valider_Forms(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('id')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $em = $this->getDoctrine()->getManager();
                $O_Forms->setDateVali(date('d-m-Y'));
                $O_Forms->setValide(1);
                $em->persist($O_Forms);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                $repository = $this->getDoctrine()->getRepository(Groups::class);
                $O_Groups = $repository->findAll();
                $O_Assoc_Groups = $O_Forms->getGroups();
                $O_Ligne = $O_Forms->getLigne();
                return $this->render('\Formulaire\header.html.twig',['formulaire'=>$O_Forms,'utils'=>$O_Utils,'groups'=>$O_Assoc_Groups,'AllGroups'=>$O_Groups]);
            
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
    public function Unvalider_Forms(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('id')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $em = $this->getDoctrine()->getManager();
                $O_Forms->setDateVali(null);
                $O_Forms->setValide(0);
                $em->persist($O_Forms);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                $repository = $this->getDoctrine()->getRepository(Groups::class);
                $O_Groups = $repository->findAll();
                $O_Assoc_Groups = $O_Forms->getGroups();
                $O_Ligne = $O_Forms->getLigne();
                return $this->render('\Formulaire\header.html.twig',['formulaire'=>$O_Forms,'utils'=>$O_Utils,'groups'=>$O_Assoc_Groups,'AllGroups'=>$O_Groups]);
            
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
    public function Restore_Forms(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('id')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $em = $this->getDoctrine()->getManager();
                $O_Forms->setDateDele(null);
                $O_Forms->setVisible(1);
                $em->persist($O_Forms);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                $repository = $this->getDoctrine()->getRepository(Groups::class);
                $O_Groups = $repository->findAll();
                $O_Assoc_Groups = $O_Forms->getGroups();
                $O_Ligne = $O_Forms->getLigne();
                return $this->render('\Formulaire\header.html.twig',['formulaire'=>$O_Forms,'utils'=>$O_Utils,'groups'=>$O_Assoc_Groups,'AllGroups'=>$O_Groups]);
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
        $O_Forms = $repository->findOneBy(['T_Slug' => $T_Slug]);
        $session = $request->getSession();
        if($session->has('utils')){
            $repository = $this->getDoctrine()->getRepository(Utils::class);
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Groups::class);
            $O_Groups = $repository->findAll();
            $O_Assoc_Groups = $O_Forms->getGroups();
            $O_Ligne = $O_Forms->getLigne();
            return $this->render('\Formulaire\Modify.Formulaire.html.twig',['formulaire'=>$O_Forms,'Lignes'=>$O_Ligne,'utils'=>$O_Utils,'groups'=>$O_Assoc_Groups,'AllGroups'=>$O_Groups]);
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
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('id')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $O_Forms_Ligne = new Ligne_Formulaire;
                $O_Forms_Ligne->setDateCrea(date('d-m-Y'));
                $O_Forms_Ligne->setIdUtilsCrea($O_Utils);
                $O_Forms_Ligne->setObli(0);
                $O_Forms_Ligne->setType(1);
                $O_Forms_Ligne->setOrdre(0);
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
    public function Delete_Ligne(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Ligne_Formulaire::class);
            $O_Forms_Ligne = $repository->findOneBy(['ID' => $request->request->get('id')]);
            $O_Forms = $O_Forms_Ligne->getForms();
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $em = $this->getDoctrine()->getManager();
                foreach($O_Forms_Ligne->getInLine() as $O_Forms_InLigne) {
                    $em->remove($O_Forms_InLigne);
                  }
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
    
    public function Clone_Ligne(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $repository = $this->getDoctrine()->getRepository(Ligne_Formulaire::class);
                $O_Forms_Ligne = $repository->findOneBy(['ID' => $request->request->get('id')]);
                
                $O_New_Forms_Ligne = new Ligne_Formulaire;
                $O_New_Forms_Ligne->setTitre($O_Forms_Ligne->getTitre());
                $O_New_Forms_Ligne->setObli($O_Forms_Ligne->getObli());
                $O_New_Forms_Ligne->setType($O_Forms_Ligne->getType());
                $O_New_Forms_Ligne->setOrdre($O_Forms_Ligne->getOrdre()+1);
                $O_New_Forms_Ligne->setForms($O_Forms_Ligne->getForms());
                $O_New_Forms_Ligne->setDateCrea(date('d-m-Y'));
                $O_New_Forms_Ligne->setIdUtilsCrea($O_Utils);
                $em = $this->getDoctrine()->getManager();
                $A_New_Forms_InLigne = null;
                foreach($O_Forms_Ligne->getInLine() as $O_Forms_InLigne) {
                    $O_New_Forms_InLigne = new InLigne_Formulaire;
                    $O_New_Forms_InLigne->setTitre($O_Forms_InLigne->getTitre());
                    $O_New_Forms_InLigne->setOrdre($O_Forms_InLigne->getOrdre());
                    $O_New_Forms_InLigne->setDateCrea(date('d-m-Y'));
                    $O_New_Forms_InLigne->setIdUtilsCrea($O_Utils);
                    $O_New_Forms_InLigne->setLigne($O_New_Forms_Ligne);
                    
                    $em->persist($O_New_Forms_InLigne);
                    $A_New_Forms_InLigne[] = $O_New_Forms_InLigne;
                }
                if($A_New_Forms_InLigne != null){
                    $O_New_Forms_Ligne->setInline($A_New_Forms_InLigne);
                }
                $em->persist($O_New_Forms_Ligne);
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
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
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
    public function ChangelineOrder(Request $request) {
        
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $A_Ordre = array_reverse($request->request->get('data'));
            for($i=0;$i < count($A_Ordre);$i++){
                $repository = $this->getDoctrine()->getRepository(Ligne_Formulaire::class);
                $O_Forms_Ligne = $repository->findOneBy(['ID' => $A_Ordre[$i]]);
                $O_Forms_Ligne->setOrdre($i);
                $O_Forms = $O_Forms_Ligne->getForms();
                if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($O_Forms_Ligne);
                    try {
                        $em->flush();
                    }
                    catch(EntityNotFoundException $e){
                        error_log($e->getMessage());
                    }
                    return new Response('OK', 200 , array('Content-Type' => 'text/html'));
                }
                else
                {
                    return new Response('KO PAS LE DROIT', 403 , array('Content-Type' => 'text/html'));
                }
            }
        }
        else
        {
            return $this->redirectToRoute('index');
        }
    }
    protected function getRandString($n) { 
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
    public function ChangeInlineOrder(Request $request) {
        
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
                $A_Ordre = array_reverse($request->request->get('data'));
                for($i=0;$i < count($A_Ordre);$i++){
                    $repository = $this->getDoctrine()->getRepository(InLigne_Formulaire::class);
                    $O_Forms_InLigne = $repository->findOneBy(['ID' => $A_Ordre[$i]]);
                    $O_Forms_Ligne = $O_Forms_InLigne->getLigne();
                    $O_Forms = $O_Forms_Ligne->getForms();
                    if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                        $O_Forms_InLigne->setOrdre($i);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($O_Forms_InLigne);
                        try {
                            $em->flush();
                        }
                        catch(EntityNotFoundException $e){
                            error_log($e->getMessage());
                        }
                    }
                    else
                    {
                        return new Response('KO PAS LE DROIT', 403 , array('Content-Type' => 'text/html'));
                    }
                }
                return new Response('OK', 200 , array('Content-Type' => 'text/html'));
        }
        else
        {
            return $this->redirectToRoute('index');
        }
    }
    public function Create_InLigne(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' =>  $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $N_Id_Ligne = $request->request->get('Id_Ligne');
                $Value = $request->request->get('Value');
                $repository = $this->getDoctrine()->getRepository(Ligne_Formulaire::class);
                $O_Forms_Ligne = $repository->findOneBy(['ID' => $N_Id_Ligne]);
                $O_Forms_InLigne = new InLigne_Formulaire;
                $O_Forms_InLigne->setDateCrea(date('d-m-Y'));
                $O_Forms_InLigne->setTitre($Value);
                $O_Forms_InLigne->setIdUtilsCrea($O_Utils);
                $O_Forms_InLigne->setLigne($O_Forms_Ligne);
                $O_Forms_InLigne->setOrdre(0);
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Forms_InLigne);
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
    public function Change_InLigne(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $N_Id = $request->request->get('Id');
                $Value = $request->request->get('Value');
                $repository = $this->getDoctrine()->getRepository(InLigne_Formulaire::class);
                $O_Forms_InLigne = $repository->findOneBy(['ID' => $N_Id]);
                $O_Forms_InLigne->setTitre($Value);
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Forms_InLigne);
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
    public function Delete_InLine(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $repository = $this->getDoctrine()->getRepository(InLigne_Formulaire::class);
                $O_Forms_InLigne = $repository->findOneBy(['ID' => $request->request->get('id')]);
                $em = $this->getDoctrine()->getManager();
                $em->remove($O_Forms_InLigne);
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
    public function Add_Groups_diffusion(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' =>  $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $T_Slug = $this->getRandString(15);
                $O_Assoc_Groups = $this->getDoctrine()->getRepository(Assoc_Formulaires_Groups::class);
                while($O_Assoc_Groups->findOneBy(['T_Slug_View' => $T_Slug])){
                    $T_Slug = $this->getRandString(15);
                }
                $O_Forms_Group = new Assoc_Formulaires_Groups;
                $O_Forms_Group->setDateCrea(date('d-m-Y'));
                $O_Forms_Group->setVisible(0);
                $O_Forms_Group->setSlug($T_Slug);
                $O_Forms_Group->setIdUtilsCrea($O_Utils);
                $O_Forms_Group->setIdFormulaires($O_Forms);
                $O_Forms_Group->setIdGroups(null);
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Forms_Group);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                $repository = $this->getDoctrine()->getRepository(Groups::class);
                $O_Groups = $repository->findAll();
                $O_Assoc_Groups = $O_Forms->getGroups();
                return $this->render('\Formulaire\header.html.twig',['formulaire'=>$O_Forms,'utils'=>$O_Utils,'groups'=>$O_Assoc_Groups,'AllGroups'=>$O_Groups]);
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
    public function Change_Groups_diffusion(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $repository = $this->getDoctrine()->getRepository(Groups::class);
                $O_Groups = $repository->findOneBy(['ID' => $request->request->get('Value')]);
                $repository = $this->getDoctrine()->getRepository(Assoc_Formulaires_Groups::class);
                $O_Assoc_Groups = $repository->findOneBy(['ID' => $request->request->get('id')]);
                $O_Assoc_Groups->setIdGroups($O_Groups);
                $em = $this->getDoctrine()->getManager();
                $em->persist($O_Assoc_Groups);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                $repository = $this->getDoctrine()->getRepository(Groups::class);
                $O_Groups = $repository->findAll();
                $O_Assoc_Groups = $O_Forms->getGroups();
                return $this->render('\Formulaire\header.html.twig',['formulaire'=>$O_Forms,'utils'=>$O_Utils,'groups'=>$O_Assoc_Groups,'AllGroups'=>$O_Groups]);
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
    public function Delete_Groups_diffusion(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Formulaire::class);
            $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
            if($O_Utils->getAdmin() == 1 | $O_Utils->getID() == $O_Forms->getIdUtilsCrea()->getID()){
                $repository = $this->getDoctrine()->getRepository(Assoc_Formulaires_Groups::class);
                $O_Assoc_Groups = $repository->findOneBy(['ID' => $request->request->get('id')]);
                $em = $this->getDoctrine()->getManager();
                $em->remove($O_Assoc_Groups);
                try {
                    $em->flush();
                }
                catch(EntityNotFoundException $e){
                    error_log($e->getMessage());
                }
                $repository = $this->getDoctrine()->getRepository(Groups::class);
                $O_Groups = $repository->findAll();
                $O_Assoc_Groups = $O_Forms->getGroups();
                return $this->render('\Formulaire\header.html.twig',['formulaire'=>$O_Forms,'utils'=>$O_Utils,'groups'=>$O_Assoc_Groups,'AllGroups'=>$O_Groups]);
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
}
?>