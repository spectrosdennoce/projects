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
     * @ORM\Column(type="string", nullable=true)
     */
    public $T_Titre;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $N_Select;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $N_Type;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;
    
    /**
     * @ORM\ManyToOne(targetEntity="Formulaire",inversedBy="O_Ligne")
     * @ORM\JoinColumn(name="N_ID_Formulaires",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Formulaires;

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
    
    function setTitre($T_data)
    {
        $this->T_Titre = $T_data;
    }
    function setSelect($N_data)
    {
        $this->N_Select = $N_data;
    }
    function setType($N_data)
    {
        $this->N_Type = $N_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setForms($N_data)
    {
        $this->N_ID_Formulaires = $N_data;
    }
    function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    function setDateDele($D_data)
    {
        $this->D_Dele = new \DateTime($D_data);
    }
    function setVisible($D_data)
    {
        $this->B_Visible = $D_data;
    }

    function getID(){
        return $this->ID;
    }
    function getTitre(){
        return $this->T_Titre;
    }
    function getSelect(){
        return $this->N_Select;
    }
    function getType(){
        return $this->N_Type;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getForms(){
        return $this->N_ID_Formulaire;
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