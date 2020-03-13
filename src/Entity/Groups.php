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
    private $ID;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $T_Titre;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    private $N_ID_Utils_Crea;
    
    /**
     * @ORM\OneToMany(targetEntity="Assoc_Formulaires_Groups",mappedBy="N_ID_Groups")
     */
    private $O_Forms;

    /**
     * @ORM\OneToMany(targetEntity="Assoc_Utilisateurs_Groups",mappedBy="N_ID_Groups")
     */
    private $O_Utils;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $D_Crea;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $D_Dele;
    
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $B_Visible;

    public function setTitre($T_data)
    {
        $this->T_Titre = $T_data;
    }
    public function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    public function setForms($O_data)
    {
        $this->O_Forms = $O_data;
    }
    public function setUtils($O_data)
    {
        $this->O_Utils = $O_data;
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    public function setDateDele($D_data)
    {
        $this->D_Dele = new \DateTime($D_data);
    }
    public function setVisisble($B_data)
    {
        $this->B_Visible = $B_data;
    }

    public function getID()
    {
        return $this->id;
    }
    public function getTitre()
    {
        return $this->T_Titre;
    }
    public function getIdUtilsCrea()
    {
        return $this->N_ID_Utils_Crea;
    }
    public function getForms()
    {
        return $this->O_Forms;
    }
    public function getUtils()
    {
        return $this->O_Utils;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
    public function getDateDele()
    {
        return $this->D_Dele;
    }
    public function getVisible()
    {
        return $this->B_Visible;
    }
}