<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Formulaire;
use App\Entity\Groups;
use App\Entity\Assoc_Formulaires_Groups;
use App\Entity\Utils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class LuckyController extends AbstractController
{
    public function number()
    {

        //$repository = $this->getDoctrine()->getRepository(Assoc_Formulaires_Groups::class);
       // $formulaires = $repository->findAll();
        //dd($formulaires);

        $repository = $this->getDoctrine()->getRepository(Formulaire::class);
        if($formulaires = $repository->find(1)){
        /*foreach($formulaires->O_Groups as $k => $group) {
            echo "moi";
            dd($group);
        }*/
        dd($formulaires->O_Groups[0]);
    }
        $repositor = $this->getDoctrine()->getRepository(Groups::class);
        $groups[] = $repositor->findAll();
        dd($groups);
        return $this->render('base.html.twig');
    }
    public function add_user(Request $request)
    {
        if($request->request->has('nom'))
        {
            $utils = new Utils;
            $utils->t_nom = $request->request->get("nom");
            $utils->t_prenom = $request->request->get("prenom");
            $utils->T_email = $request->request->get("mail");
            $utils->t_mdp = $request->request->get("mdp");
            $utils->b_admin = 1;
            $utils->d_crea = date(23/01/2020);
            $em = $this->getDoctrine()->getManager();
            $em->persist($utils);
            $em->flash();
        }
            return $this->render('base.html.twig');
    }
}