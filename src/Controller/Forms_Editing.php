<?php

namespace App\Controller;

use App\Entity\Utils;
use App\Entity\Formulaire;
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
        //envoyer en bdd avec un try catch exeption (a voir interer)
        $em = $this->getDoctrine()->getManager();
        $em->persist($O_Forms);
        try {
            $em->flush();
        }
        catch(EntityNotFoundException $e){
            error_log($e->getMessage());
        }
        //redirige vers Menu.html.twig
        return $this->redirectToRoute('index');
    }
    public function Read(Request $request,string $T_Slug)
    {
        $O_Utils = null;
        $O_Forms = new Formulaire;
        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        $O_Forms = $repository->findOneBy(['T_Slug' => $T_Slug]);
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        $session = $request->getSession();
        if($session->has('utils')){
            $O_Utils = $repository->find($session->get('utils'));
        }
        return $this->render('\Formulaire\Read.Formulaire.html.twig',['O_Forms'=>$O_Forms,'utils'=>$O_Utils]);
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
