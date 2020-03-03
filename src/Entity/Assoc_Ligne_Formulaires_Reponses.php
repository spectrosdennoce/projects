<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Assoc_Formulaires_Reponses")
 */
class Assoc_Ligne_Formulaires_Reponses
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Ligne_Formulaire",inversedBy="O_Reponses")
     * @ORM\JoinColumn(name="Lignes_Formulaire",referencedColumnName="id")
     */
    public $O_Lignes_Formulaires;
    /**
     * @ORM\ManyToOne(targetEntity="Reponse_Formulaire",inversedBy="O_Ligne_Forms")
     * @ORM\JoinColumn(name="Reponse_Formulaire",referencedColumnName="id")
     */
    public $O_Reponses;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id")
     */
    public $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="date")
     */
    public $D_Crea;

    public function __construct(){
        $this->O_Lignes_Formulaires = new ArrayCollection();
        $this->O_Reponses = new ArrayCollection();
        $this->N_ID_Utils_Crea = new ArrayCollection();
    }
    function setIdLignesFormulaires($N_data)
    {
        $this->O_Lignes_Formulaires = $N_data;
    }
    function setIdReponses($N_data)
    {
        $this->O_Reponses = $N_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }

    function getID(){
        return $this->ID;
    }
    function getLignesFormulaires(){
        return $this->O_Lignes_Formulaires;
    }
    function getID_Reponses(){
        return $this->O_Reponses;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getDateCrea(){
        return $this->D_Crea;
    }
}