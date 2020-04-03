<?php

namespace App\Controller;

use App\Entity\Assoc_Formulaires_Groups;
use App\Entity\Utils;
use App\Entity\Formulaire;
use App\Entity\Groups;
use App\Entity\Ligne_Formulaire;
use App\Entity\InLigne_Formulaire;
use App\Entity\Reponse_Formulaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
class Forms_Response extends AbstractController
{
    public function Form_Vue(Request $request,string $T_Slug_View)
    {
        $O_Utils = null;
        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        $O_Forms = $repository->findOneBy(['T_Slug_View' => $T_Slug_View]);
        $session = $request->getSession();
        if($session->has('utils')){
            $repository = $this->getDoctrine()->getRepository(Utils::class);
            $O_Utils = $repository->find($session->get('utils'));
            $O_Lignes = $O_Forms->getLigne();
            foreach($O_Lignes as $O_Ligne){
                foreach($O_Ligne->getReponse() as $O_Reponses){
                    if($O_Reponses->getIdUtilsCrea() == $O_Utils){
                        $A_Reponse[] = $O_Reponses->getID_Reponses();
                    }
                }
            }
            return $this->render('\Formulaire\Response.Formulaire.html.twig',['formulaire'=>$O_Forms,'Lignes'=>$O_Lignes,'Reponses'=>$A_Reponse,'utils'=>$O_Utils]);
        }
        else
        {
            return $this->redirectToRoute('index',['T_Slug_View'=>$T_Slug_View]);
        }
    }
}