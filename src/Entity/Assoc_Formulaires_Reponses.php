<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Assoc_Formulaires_Reponses")
 */
class Assoc_Formulaires_Reponses
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Formulaire",inversedBy="O_Reponses")
     * @ORM\JoinColumn(name="Formulaire",referencedColumnName="id")
     */
    public $N_ID_Formulaires;
    /**
     * @ORM\ManyToOne(targetEntity="Reponse_Formulaire",inversedBy="O_Forms")
     * @ORM\JoinColumn(name="Reponse_Formulaire",referencedColumnName="id")
     */
    public $N_ID_Reponses;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id")
     */
    public $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="date")
     */
    public $D_Crea;

    /**
     * @ORM\Column(type="date")
     */
    public $D_Dele;
}