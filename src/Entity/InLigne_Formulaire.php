<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="InLigne_Formulaire")
 */
class InLigne_Formulaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $ID;

    /**
     * @ORM\Column(name="t_titre",type="string", nullable=true)
     */
    public $T_Titre;
    /**
     * @ORM\Column(name="n_ordre", type="integer", nullable=true)
     */
    public $N_Ordre;
    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ligne_Formulaire",inversedBy="O_Inline")
     * @ORM\JoinColumn(name="Ligne_Formulaire",referencedColumnName="id")
     */
    public $O_Ligne;
    /**
     * @ORM\Column(name="d_crea",type="date", nullable=false)
     */
    public $D_Crea;
    
    
    function setTitre($T_data)
    {
        $this->T_Titre = $T_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setOrdre($N_data)
    {
        $this->N_Ordre = $N_data;
    }
    function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    function setLigne($O_data)
    {
        $this->O_Ligne = $O_data;
    }

    function getID(){
        return $this->ID;
    }
    function getLigne(){
        return $this->O_Ligne;
    }
    function getTitre(){
        return $this->T_Titre;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getOrdre(){
        return $this->N_Ordre;
    }
    function getDateCrea(){
        return $this->D_Crea;
    }
}