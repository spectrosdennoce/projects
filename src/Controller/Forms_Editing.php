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
        $repository = $this->getDoctrine()->getRepository(Utils::class);
        if($O_Utils = $repository->findOneBy(['T_Pseudo' => 'spectros'])){
            $O_Forms->setIdUtilsCrea($O_Utils);
        }
        $O_Forms->setTitre('n1');
        $O_Forms->setDateCrea('10/02/2020');
        $O_Forms->setSlug('eblmsjbopqsi');
        $em = $this->getDoctrine()->getManager();
        $em->persist($O_Forms);
        try {
            $em->flush();
        }
        catch(EntityNotFoundException $e){
            error_log($e->getMessage());
        }
    }
}
?>
