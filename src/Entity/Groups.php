<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Groups")
 */
class Groups
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
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;
    
    /**
     * @ORM\OneToMany(targetEntity="Assoc_Formulaires_Groups",mappedBy="N_ID_Groups")
     * @ORM\JoinColumn(name="Assoc_Formulaires_Groups",referencedColumnName="Groups")
     */
    public $O_Forms;
    /**
     * @ORM\OneToMany(targetEntity="Assoc_Utilisateurs_Groups",mappedBy="N_ID_Groups")
     * @ORM\JoinColumn(name="Assoc_Utilisateurs_Groups",referencedColumnName="Groups")
     */
    public $O_Utils;

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

    function setTitre($T_data)
    {
        $this->T_Titre = $T_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setForms($O_data)
    {
        $this->O_Forms = $O_data;
    }
    function setUtils($O_data)
    {
        $this->O_Utils = $O_data;
    }
    function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    function setDateDele($D_data)
    {
        $this->D_Dele = new \DateTime($D_data);
    }
    function setVisisble($B_data)
    {
        $this->B_Visible = $B_data;
    }

    function getID(){
        return $this->id;
    }
    function getTitre(){
        return $this->T_Titre;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getForms(){
        return $this->O_Forms;
    }
    function getUtils(){
        return $this->O_Utils;
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