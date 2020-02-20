<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Assoc_Utilisateurs_Groups")
 */
class Assoc_Utilisateurs_Groups
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Groups",inversedBy="O_Utils")
     * @ORM\JoinColumn(name="N_ID_Groups",referencedColumnName="id")
     */
    public $N_ID_Groups;

    /**
     * @ORM\ManyToOne(targetEntity="Utils",inversedBy="O_Groups")
     * @ORM\JoinColumn(name="N_ID_Utils",referencedColumnName="id")
     */
    public $N_ID_Utils;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id")
     */
    public $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="boolean")
     */
    public $B_Deleguer;

    /**
     * @ORM\Column(type="date")
     */
    public $D_Crea;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $D_Dele;
    
    public function __construct(){
        $this->N_ID_Groups = new ArrayCollection();
        $this->N_ID_Utils = new ArrayCollection();
        $this->N_ID_Utils_Crea = new ArrayCollection();
    }
    function setIdGroups($T_data)
    {
        $this->N_ID_Groups = $T_data;
    }
    function setIdUtils($T_data)
    {
        $this->N_ID_Utils = $T_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setDelegue($B_data)
    {
        $this->B_Deleguer = $B_data;
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
    function getIdGroups(){
        return $this->N_ID_Groups;
    }
    function getIdUtils(){
        return $this->N_ID_Utils;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getDelegue(){
        return $this->B_Deleguer;
    }
    function getDateCrea(){
        return $this->D_Crea;
    }
    function getDateDele(){
        return $this->D_Dele;
    }
}