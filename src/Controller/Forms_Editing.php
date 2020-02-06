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
    public function Creation()
    {
        $O_Forms = new Formulaire;
        
        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        $T_Slug = $this->getRandString(15);
        while($repository->findOneBy(['T_Slug' => $T_Slug])){
            $T_Slug = $this->getRandString(15);
        }
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        if($O_Utils = $repository->findOneBy(['T_Pseudo' => 'yolo'])){
            $O_Forms->setIdUtilsCrea($O_Utils);
        }
        $O_Forms->setDateCrea(date('d/m/Y'));
        $O_Forms->setSlug($T_Slug);
        $em = $this->getDoctrine()->getManager();
        $em->persist($O_Forms);
        try {
            $em->flush();
        }
        catch(EntityNotFoundException $e){
            error_log($e->getMessage());
        }
        return $this->redirectToRoute('index');
    }
    public function Read(string $T_Slug)
    {
        return $this->render('\Formulaire\Read.Formulaire.html.twig',['T_Slug'=>$T_Slug]);
    }
    function getRandString($n) { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString; 
    } 
}
?>
