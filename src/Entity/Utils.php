<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Utils")
 * @UniqueEntity(fields="t_email", message="Email déjà pris")
 * @UniqueEntity(fields="t_pseudo", message="Username déjà pris")
 */
class Utils
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $ID;

    /**
     * @ORM\Column(type="string", nullable=false, name="t_nom")
     */
    public $T_Nom;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true, name="t_pseudo")
     */
    public $T_Pseudo;

    /**
     * @ORM\Column(type="string", nullable=false, name="t_prenom")
     */
    public $T_Prenom;

    /**
     * @ORM\Column(type="string", nullable=false, name="t_email")
     */
    public $T_Email;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true, name="t_mdp")
     */
    public $T_Mdp;

    /**
     * @ORM\Column(type="boolean", nullable=true, name="b_admin")
     */
    public $B_Admin;

    /**
     * @ORM\Column(type="date", nullable=false, name="d_crea")
     */
    public $D_Crea;

    
    public function setNom($T_data)
    {
        $this->T_Nom = $T_data;
    }
    public function setPseudo($T_data)
    {
        $this->T_Pseudo = $T_data;
    }
    public function setPrenom($T_data)
    {
        $this->T_Prenom = $T_data;
    }
    public function setEmail($T_data)
    {
        $this->T_Email = $T_data;
    }
    public function setMdp($T_data)
    {
        $this->T_Mdp = $T_data;
    }
    public function setAdmin($B_data)
    {
        $this->B_Admin = $B_data;
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }


    public function getNom()
    {
        return $this->T_Nom;
    }
    public function getPseudo()
    {
        return $this->T_Pseudo;
    }
    public function getPrenom()
    {
        return $this->T_Prenom;
    }
    public function getEmail()
    {
        return $this->T_Email;
    }
    public function getMdp()
    {
        return $this->T_Mdp;
    }
    public function getAdmin()
    {
        return $this->B_Admin;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
}