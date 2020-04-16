<?php

namespace App\Controller;

use App\Entity\Assoc_Formulaires_Groups;
use App\Entity\Utils;
use App\Entity\Formulaire;
use App\Entity\Groups;
use App\Entity\Ligne_Formulaire;
use App\Entity\InLigne_Formulaire;
use App\Entity\Response_Ligne;
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
            $A_Reponse = null;
            $B_Vali = false;
            foreach($O_Lignes as $O_Ligne){
                foreach($O_Ligne->getReponse() as $O_Reponses){
                    if($O_Reponses->getVali() == true && $O_Reponses->getIdUtilsCrea() == $O_Utils)
                    {
                        $B_Vali = true;
                    }
                    if($O_Reponses->getIdUtilsCrea() == $O_Utils){
                        $A_Reponse[] = $O_Reponses;
                    }
                }
            }
            return $this->render('\Formulaire\Response.Formulaire.html.twig',['formulaire'=>$O_Forms,'Lignes'=>$O_Lignes,'Reponses'=>$A_Reponse,'utils'=>$O_Utils,'Disabled'=>$B_Vali]);
        }
        else
        {
            return $this->redirectToRoute('index',['T_Slug_View'=>$T_Slug_View]);
        }
    }
    public function Change_Reponse_Ligne(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
        $session = $request->getSession();
        if($session->has('utils'))
        {
            $repository = $this->getDoctrine()->getRepository(Utils::class);
            $O_Utils = $repository->find($session->get('utils'));
            $repository = $this->getDoctrine()->getRepository(Response_Ligne::class);
            if($request->request->get('Parent') == "text" )
            {
                $O_Reponse = $repository->findOneBy(['N_Id_Ligne' => $request->request->get('Id'),'N_ID_Utils_Crea' => $O_Utils->getId()]);
            }
            else
            {
                $O_Reponse = $repository->findOneBy(['N_Id_Ligne' => $request->request->get('Parent'),'N_ID_Utils_Crea' => $O_Utils->getId()]);
            }
            if($O_Reponse)
            {
                if($request->request->get('Parent') == 'text')
                {
                    $value = $request->request->get('Value');
                    $O_Reponse->setReponse($value);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($O_Reponse);
                    try {
                        $em->flush();
                    }
                    catch(EntityNotFoundException $e){
                        error_log($e->getMessage());
                        return new Response('ko', 403 , array('Content-Type' => 'text/html'));
                    }
                }
                else
                {
                    $value = $request->request->get('Id');
                    $O_Ligne = $O_Reponse->getLignesForms();
                    if($O_Ligne->getType() == 4)
                    {
                        $em = $this->getDoctrine()->getManager();
                        if($request->request->get('Value') == "false")
                        {
                            $repository = $this->getDoctrine()->getRepository(Response_Ligne::class);
                            $O_Reponse = $repository->findOneBy(['T_Reponse' => $request->request->get('Id'),'N_Id_Ligne' => $request->request->get('Parent'),'N_ID_Utils_Crea' => $O_Utils->getId()]);
                            $em->remove($O_Reponse);
                        }
                        else{
                            if($O_Reponse->getId() == $request->request->get('id'))
                            {
                                $O_Reponse->setReponse($value);
                            }
                            else
                            {
                                $O_Reponse = new Response_Ligne;
                                $O_Reponse->setReponse($value);
                                $O_Reponse->setIdLignesFormulaires($O_Ligne);
                                $O_Reponse->setIdUtilsCrea($O_Utils);
                                $O_Reponse->setVali(0);
                                $O_Reponse->setDateCrea(date('d-m-Y'));
                            }
                            $em->persist($O_Reponse);
                        }
                        try {
                            $em->flush();
                        }
                        catch(EntityNotFoundException $e){
                            error_log($e->getMessage());
                            return new Response('ko', 403 , array('Content-Type' => 'text/html'));
                        }
                    }
                    else if($O_Ligne->getType() == 3)
                    {
                        $em = $this->getDoctrine()->getManager();
                        foreach($O_Ligne->getReponse() as $O_Reponse_Ligne)
                        {
                            $em->remove($O_Reponse_Ligne);
                        }
                        $em = $this->getDoctrine()->getManager();
                        $O_New_Reponse = new Response_Ligne;
                        $O_New_Reponse->setReponse($value);
                        $O_New_Reponse->setIdLignesFormulaires($O_Ligne);
                        $O_New_Reponse->setIdUtilsCrea($O_Utils);
                        $O_New_Reponse->setVali(0);
                        $O_New_Reponse->setDateCrea(date('d-m-Y'));
                        $em->persist($O_New_Reponse);
                        try {
                            $em->flush();
                        }
                        catch(EntityNotFoundException $e){
                            error_log($e->getMessage());
                            return new Response('ko', 403 , array('Content-Type' => 'text/html'));
                        }
                    }
                }
            }
            else
            {
                $repository = $this->getDoctrine()->getRepository(Ligne_Formulaire::class);
                $O_Reponse = $repository->findOneBy(['ID' => $request->request->get('Id')]);
                if($request->request->get('Parent') == "text" )
                {
                    $O_Ligne = $repository->findOneBy(['ID' => $request->request->get('Id')]);
                    $value = $request->request->get('Value');
                }
                else
                {
                    $O_Ligne = $repository->findOneBy(['ID' => $request->request->get('Parent')]);
                    $value = $request->request->get('Id');
                }
                $em = $this->getDoctrine()->getManager();
                $O_New_Reponse = new Response_Ligne;
                $O_New_Reponse->setReponse($value);
                $O_New_Reponse->setIdLignesFormulaires($O_Ligne);
                $O_New_Reponse->setIdUtilsCrea($O_Utils);
                $O_New_Reponse->setVali(0);
                $O_New_Reponse->setDateCrea(date('d-m-Y'));
                $em->persist($O_New_Reponse);
                try 
                {
                    $em->flush();
                }
                catch(EntityNotFoundException $e)
                {
                    error_log($e->getMessage());
                    return new Response('ko', 403 , array('Content-Type' => 'text/html'));
                }
            }
            return new Response('ok', 202 , array('Content-Type' => 'text/html'));
        }
        else
        {
            return $this->redirect("/Formulaire/".$O_Forms->getSlugView());
        }
    }
    public function Change_State_Ligne(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        $O_Forms = $repository->findOneBy(['ID' => $request->request->get('Id_Forms')]);
        $session = $request->getSession();
        if($session->has('utils'))
        {
            $repository = $this->getDoctrine()->getRepository(Utils::class);
            $O_Utils = $repository->find($session->get('utils'));
            $O_Ligne = $O_Forms->getLigne();
            $em = $this->getDoctrine()->getManager();
            foreach($O_Ligne as $O_Lign)
            {
                foreach($O_Lign->getReponse() as $O_Reponse)
                {
                    if($O_Reponse->getIdUtilsCrea() == $O_Utils)
                    {
                        $O_Reponse->setVali(1);
                    }
                }
            }
            $em->persist($O_Reponse);
            try 
            {
                $em->flush();
            }
            catch(EntityNotFoundException $e)
            {
                error_log($e->getMessage());
                return new Response('ko', 403 , array('Content-Type' => 'text/html'));
            }
            return new Response('ok', 202 , array('Content-Type' => 'text/html'));
        }
        else
        {
            return $this->redirect("/Formulaire/".$O_Forms->getSlugView());
        }
    }
}