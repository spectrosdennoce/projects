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
     * @ORM\Column(type="string", nullable=true, name="t_titre")
     */
    public $T_Titre;
    /**
     * @ORM\Column(type="boolean", nullable=true, name="b_obligation")
     */
    public $B_Obligation;
    /**
     * @ORM\Column(type="string", nullable=false, unique=true, name="t_slug")
     */
    public $T_Slug;

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
     * @ORM\OneToMany(targetEntity="Ligne_Formulaire",mappedBy="N_ID_Formulaires")
     * @ORM\JoinColumn(name="Ligne_Formulaire",referencedColumnName="Formulaire")
     */
    public $O_Ligne;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="date", nullable=false, name="d_crea")
     */
    public $D_Crea;
    
    /**
     * @ORM\Column(type="date", nullable=true, name="d_dele")
     */
    public $D_Dele;
    
    /**
     * @ORM\Column(type="boolean", nullable=false, name="b_visible")
     */
    
    public $B_Visible;

    function setTitre($T_data)
    {
        $this->T_Titre = $T_data;
    }
    function setObligation($B_data)
    {
        $this->B_Obligation = $B_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setGroups($O_data)
    {
        $this->O_Groups = $O_data;
    }
    function setReponse($O_data)
    {
        $this->O_Reponses = $O_data;
    }
    function setLigne($O_data)
    {
        $this->O_Ligne = $O_data;
    }
    function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    function setDateDele($D_data)
    {
        $this->D_Dele = new \DateTime($D_data);
    }
    function setVisible($B_data)
    {
        $this->B_Visible = $B_data;
    }
    function setSlug($T_data)
    {
        $this->T_Slug = $T_data;
    }

    function getID(){
        return $this->ID;
    }
    function getObligation(){
        return $this->B_Obligation;
    }
    function getTitre(){
        return $this->T_Titre;
    }
    function getGroups()
    {
        return $this->O_Groups;
    }
    function getReponse()
    {
        return $this->O_Reponses;
    }
    function getLigne()
    {
        return $this->O_Ligne;
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
    function getSlug(){
        return $this->T_Slug;
    }
}