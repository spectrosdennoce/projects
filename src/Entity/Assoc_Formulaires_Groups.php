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
    private $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Formulaire",inversedBy="O_Groups")
     * @ORM\JoinColumn(name="Formulaire",referencedColumnName="id")
     */
    private $N_ID_Formulaires;

    /**
     * @ORM\ManyToOne(targetEntity="Groups",inversedBy="O_Forms")
     * @ORM\JoinColumn(name="Groups",referencedColumnName="id")
     */
    private $N_ID_Groups;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id")
     */
    private $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="date")
     */
    private $D_Crea;
    
    /**
     * @ORM\Column(type="string", nullable=false, unique=true, name="t_slug_view")
     */
    private $T_Slug_View;

    /**
     * @ORM\Column(type="boolean")
     */
    private $B_Visible;
    
    public function __construct()
    {
        $this->N_ID_Formulaires = new ArrayCollection();
        $this->N_ID_Groups = new ArrayCollection();
        $this->N_ID_Utils_Crea = new ArrayCollection();
    }
    public function setIdFormulaires($N_data)
    {
        $this->N_ID_Formulaires = $N_data;
    }
    public function setIdGroups($N_data)
    {
        $this->N_ID_Groups = $N_data;
    }
    public function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    public function setSlug($T_data)
    {
        $this->T_Slug_View = $T_data;
    }

    public function getID()
    {
        return $this->ID;
    }
    public function getIdForm()
    {
        return $this->N_ID_Formulaires;
    }
    public function getIdUtilsCrea()
    {
        return $this->N_ID_Utils_Crea;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
    public function getSlug()
    {
        return $this->T_Slug_View;
    }
}