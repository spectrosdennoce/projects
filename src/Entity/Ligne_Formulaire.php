<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Ligne_Formulaire")
 */
class Ligne_Formulaire
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
    public $T_Titre;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    public $N_Type;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;
    
    /**
     * @ORM\OneToOne(targetEntity="Formulaire")
     * @ORM\JoinColumn(name="N_ID_Formulaire",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Formulaire;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    public $D_Crea;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $D_Dele;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $B_Visible;
    
}