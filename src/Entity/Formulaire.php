<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Formulaire")
 */
class Formulaire
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
     * @ORM\OneToMany(targetEntity="Assoc_Formulaires_Groups",mappedBy="N_ID_Formulaires")
     * @ORM\JoinColumn(name="Assoc_Formulaires_Groups",referencedColumnName="Formulaire")
     */
    public $O_Groups;

    /**
     * @ORM\OneToMany(targetEntity="Assoc_Formulaires_Reponses",mappedBy="N_ID_Formulaires")
     * @ORM\JoinColumn(name="Assoc_Formulaires_Reponses",referencedColumnName="Formulaire")
     */
    public $O_Reponses;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;

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
    
    /*function getTitre(){
        $result = $this->T_Titre;
        return $result;
    }
    public function __construct(){
        $this->O_Groups = new ArrayCollection();
    }*/
    function setTitre($T_Titre)
    {
        $this->t_titre = $T_Titre;
    }
    function setIdUtilsCrea($N_ID_Utils_Crea)
    {
        $this->n_id_utils_crea = $N_ID_Utils_Crea;
    }
    function setDateCrea($D_Crea)
    {
        $this->d_crea = $D_Crea;
    }
    function setDateDele($D_Dele)
    {
        $this->d_dele = $D_Dele;
    }
    function setVisible($B_Visible)
    {
        $this->b_visible = $B_Visible;
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