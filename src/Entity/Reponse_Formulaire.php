<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Reponse_Formulaire")
 */
class Reponse_Formulaire
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
    public $T_Reponse;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;

    /**
     * @ORM\OneToMany(targetEntity="Assoc_Formulaires_Reponses",mappedBy="N_ID_Reponses")
     * @ORM\JoinColumn(name="Assoc_Formulaires_Reponses",referencedColumnName="Reponse_Formulaire")
     */
    public $O_Forms;

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