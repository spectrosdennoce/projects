<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Assoc_Formulaires_Groups")
 */
class Assoc_Formulaires_Groups
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Formulaire",inversedBy="O_Groups")
     * @ORM\JoinColumn(name="Formulaire",referencedColumnName="id")
     */
    public $N_ID_Formulaires;

    /**
     * @ORM\ManyToOne(targetEntity="Groups",inversedBy="O_Forms")
     * @ORM\JoinColumn(name="Groups",referencedColumnName="id")
     */
    public $N_ID_Groups;

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
    /**
     * @ORM\Column(type="string", nullable=false, unique=true, name="t_slug_view")
     */
    public $T_Slug_View;
    /**
     * @ORM\Column(type="boolean")
     */
    public $B_Visible;
    public function __construct(){
        $this->N_ID_Formulaires = new ArrayCollection();
        $this->N_ID_Groups = new ArrayCollection();
        $this->N_ID_Utils_Crea = new ArrayCollection();
    }
    function setIdFormulaires($N_data)
    {
        $this->N_ID_Formulaires = $N_data;
    }
    function setIdGroups($N_data)
    {
        $this->N_ID_Groups = $N_data;
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
    function setSlug($T_data)
    {
        $this->T_Slug_View = $T_data;
    }

    function getID(){
        return $this->ID;
    }
    function getIdForm(){
        return $this->N_ID_Formulaires;
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
    function getSlug(){
        return $this->T_Slug_View;
    }
}