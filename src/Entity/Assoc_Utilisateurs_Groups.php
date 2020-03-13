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
    private $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Groups",inversedBy="O_Utils")
     * @ORM\JoinColumn(name="N_ID_Groups",referencedColumnName="id")
     */
    private $N_ID_Groups;
    
    /**
     * @ORM\ManyToOne(targetEntity="Utils",inversedBy="O_Groups")
     * @ORM\JoinColumn(name="N_ID_Utils",referencedColumnName="id")
     */
    private $N_ID_Utils;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id")
     */
    private $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="boolean")
     */
    private $B_Deleguer;

    /**
     * @ORM\Column(type="date")
     */
    private $D_Crea;
    
    public function __construct()
    {
        $this->N_ID_Groups = new ArrayCollection();
        $this->N_ID_Utils = new ArrayCollection();
        $this->N_ID_Utils_Crea = new ArrayCollection();
    }
    public function setIdGroups($T_data)
    {
        $this->N_ID_Groups = $T_data;
    }
    public function setIdUtils($T_data)
    {
        $this->N_ID_Utils = $T_data;
    }
    public function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    public function setDelegue($B_data)
    {
        $this->B_Deleguer = $B_data;
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }

    public function getID()
    {
        return $this->ID;
    }
    public function getIdGroups()
    {
        return $this->N_ID_Groups;
    }
    public function getIdUtils()
    {
        return $this->N_ID_Utils;
    }
    public function getIdUtilsCrea()
    {
        return $this->N_ID_Utils_Crea;
    }
    public function getDelegue()
    {
        return $this->B_Deleguer;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
}