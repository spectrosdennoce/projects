<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Utils")
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
     * @ORM\Column(type="string", nullable=false)
     */
    public $T_Nom;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    public $T_Prenom;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    public $T_Email;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    public $T_Mdp;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $B_Admin;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    public $D_Crea;
    
}