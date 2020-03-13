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
    private $ID;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $T_Titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $N_Ordre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $B_Obli;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    private $N_ID_Utils_Crea;
    
    /**
     * @ORM\ManyToOne(targetEntity="Formulaire",inversedBy="O_Ligne")
     * @ORM\JoinColumn(name="N_ID_Formulaires",referencedColumnName="id", nullable=false)
     */
    private $N_ID_Formulaires;

    /**
     * @ORM\OneToMany(targetEntity="Assoc_Ligne_Formulaires_Reponses",mappedBy="O_Lignes_Formulaires")
     */
    private $O_Reponses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $N_Type;

    /**
     * @ORM\OneToMany(targetEntity="InLigne_Formulaire",mappedBy="O_Ligne")
     * @ORM\JoinColumn(name="InLigne_Formulaire",referencedColumnName="id")
     * @ORM\OrderBy({"N_Ordre" = "ASC"})
     */
    private $O_Inline;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $D_Crea;
    
    public function setTitre($T_data)
    {
        $this->T_Titre = $T_data;
    }
    public function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    public function setReponse($O_data)
    {
        $this->O_Reponses = $O_data;
    }
    public function setType($N_data)
    {
        $this->N_Type = $N_data;
    }
    public function setInline($O_data)
    {
        $this->O_Inline = $O_data;
    }
    public function setForms($N_data)
    {
        $this->N_ID_Formulaires = $N_data;
    }
    public function setOrdre($N_data)
    {
        $this->N_Ordre = ($N_data > 0) ? -$N_data : $N_data;
    }
    public function setObli($B_data)
    {
        $this->B_Obli = $B_data;
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }

    public function getID()
    {
        return $this->ID;
    }
    public function getTitre()
    {
        return $this->T_Titre;
    }
    public function getReponse()
    {
        return $this->O_Reponses;
    }
    public function getInline()
    {
        return $this->O_Inline;
    }
    public function getIdUtilsCrea()
    {
        return $this->N_ID_Utils_Crea;
    }
    public function getType()
    {
        return $this->N_Type;
    }
    public function getForms()
    {
        return $this->N_ID_Formulaires;
    }
    public function getOrdre()
    {
        return $this->N_Ordre;
    }
    public function getObli()
    {
        return $this->B_Obli;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
}