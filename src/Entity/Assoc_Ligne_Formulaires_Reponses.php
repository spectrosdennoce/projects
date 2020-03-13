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
    private $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Ligne_Formulaire",inversedBy="O_Reponses")
     * @ORM\JoinColumn(name="Lignes_Formulaire",referencedColumnName="id")
     */
    private $O_Lignes_Formulaires;
    /**
     * @ORM\ManyToOne(targetEntity="Reponse_Formulaire",inversedBy="O_Ligne_Forms")
     * @ORM\JoinColumn(name="Reponse_Formulaire",referencedColumnName="id")
     */
    private $O_Reponses;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id")
     */
    private $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="date")
     */
    private $D_Crea;

    public function __construct(){
        $this->O_Lignes_Formulaires = new ArrayCollection();
        $this->O_Reponses = new ArrayCollection();
        $this->N_ID_Utils_Crea = new ArrayCollection();
    }
    public function setIdLignesFormulaires($N_data)
    {
        $this->O_Lignes_Formulaires = $N_data;
    }
    public function setIdReponses($N_data)
    {
        $this->O_Reponses = $N_data;
    }
    public function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }

    public function getID()
    {
        return $this->ID;
    }
    public function getLignesFormulaires()
    {
        return $this->O_Lignes_Formulaires;
    }
    public function getID_Reponses()
    {
        return $this->O_Reponses;
    }
    public function getIdUtilsCrea()
    {
        return $this->N_ID_Utils_Crea;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
}