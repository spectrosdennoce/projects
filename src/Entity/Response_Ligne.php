<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Response_Ligne")
 */
class Response_Ligne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Ligne_Formulaire",inversedBy="O_Ligne_Reponses")
     * @ORM\JoinColumn(name="N_Id_Ligne",referencedColumnName="id")
     */
    private $N_Id_Ligne;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $T_Reponse;

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
     * @ORM\Column(type="boolean")
     */
    private $B_Vali;

    public function __construct(){
        $this->N_Id_Ligne = new ArrayCollection();
        $this->N_ID_Utils_Crea = new ArrayCollection();
    }
    public function setIdLignesFormulaires($N_data)
    {
        $this->N_Id_Ligne = $N_data;
    }
    public function setReponse($N_data)
    {
        $this->T_Reponse = $N_data;
    }
    public function setVali($B_data)
    {
        $this->B_Vali = $B_data;
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
    public function getLignesForms()
    {
        return $this->N_Id_Ligne;
    }
    public function getReponse()
    {
        return $this->T_Reponse;
    }
    public function getIdUtilsCrea()
    {
        return $this->N_ID_Utils_Crea;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
    public function getVali()
    {
        return $this->B_Vali;
    }
}