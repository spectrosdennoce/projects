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
    public $ID;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $T_Titre;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $N_Ordre;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $B_Obli;
    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;
    
    /**
     * @ORM\ManyToOne(targetEntity="Formulaire",inversedBy="O_Ligne")
     * @ORM\JoinColumn(name="N_ID_Formulaires",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Formulaires;
    /**
     * @ORM\OneToMany(targetEntity="Assoc_Ligne_Formulaires_Reponses",mappedBy="O_Lignes_Formulaires")
     * @ORM\JoinColumn(name="Assoc_Ligne_Formulaires_Reponses",referencedColumnName="Lignes_Formulaire")
     */
    public $O_Reponses;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $N_Type;
    /**
     * @ORM\OneToMany(targetEntity="InLigne_Formulaire",mappedBy="O_Ligne")
     * @ORM\JoinColumn(name="InLigne_Formulaire",referencedColumnName="Lignes_Formulaire")
     * @ORM\OrderBy({"N_Ordre" = "ASC"})
     */
    public $O_Inline;
    /**
     * @ORM\Column(type="date", nullable=false)
     */
    public $D_Crea;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $D_Dele;
    
    /**
     * @ORM\Column(type="boolean", nullable=false)
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
    function setReponse($O_data)
    {
        $this->O_Reponses = $O_data;
    }
    function setType($N_data)
    {
        $this->N_Type = $N_data;
    }
    function setInline($O_data)
    {
        $this->O_Inline = $O_data;
    }
    function setForms($N_data)
    {
        $this->N_ID_Formulaires = $N_data;
    }
    function setOrdre($N_data)
    {
        $this->N_Ordre = ($N_data > 0) ? -$N_data : $N_data;
    }
    function setObli($B_data)
    {
        $this->B_Obli = $B_data;
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

    function getID(){
        return $this->ID;
    }
    function getTitre(){
        return $this->T_Titre;
    }
    function getReponse()
    {
        return $this->O_Reponses;
    }
    function getInline()
    {
        return $this->O_Inline;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getType(){
        return $this->N_Type;
    }
    function getForms(){
        return $this->N_ID_Formulaires;
    }
    function getOrdre(){
        return $this->N_Ordre;
    }
    function getObli(){
        return $this->B_Obli;
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