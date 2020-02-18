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
     * @ORM\Column(type="boolean", nullable=false)
     */
    public $B_Visible;
    
    function setReponse($T_data)
    {
        $this->T_Reponse = $T_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setForms($O_data)
    {
        $this->O_Forms = $O_data;
    }
    function setGroups($O_data)
    {
        $this->O_Groups = $O_data;
    }
    function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    function setDateDele($D_data)
    {
        $this->D_Dele = new \DateTime($D_data);
    }
    function setVisisble($D_data)
    {
        $this->B_Visible = $B_Visible;
    }

    function getID(){
        return $this->id;
    }
    function getReponse(){
        return $this->T_Reponse;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getForm(){
        return $this->O_Forms;
    }
    function getGroups(){
        return $this->O_Groups;
    }
    function getDateCrea(){
        return $this->D_Crea;
    }
    function getDateDele(){
        return $this->D_Dele;
    }
    function getVisible(){
        return $this->B_Visible;
    }
}