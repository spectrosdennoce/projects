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
     * @ORM\Column(type="date", nullable=true)
     */
    public $D_Dele;

    public function __construct(){
        $this->N_ID_Formulaires = new ArrayCollection();
        $this->N_ID_Reponses = new ArrayCollection();
        $this->N_ID_Utils_Crea = new ArrayCollection();
    }
    function setIdFormulaires($N_data)
    {
        $this->N_ID_Formulaires = $N_data;
    }
    function setIdReponses($N_data)
    {
        $this->N_ID_Reponses = $N_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    function setDateDele($D_data)
    {
        $this->D_Dele = new \DateTime($D_data);
    }

    function getID(){
        return $this->ID;
    }
    function getID_Formulaires(){
        return $this->N_ID_Formulaires;
    }
    function getID_Reponses(){
        return $this->N_ID_Reponses;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getDateCrea(){
        return $this->D_Crea;
    }
    function getDateDele(){
        return $this->D_Dele;
    }
}