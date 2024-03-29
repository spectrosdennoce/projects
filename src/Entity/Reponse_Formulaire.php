<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Reponse_Formulaire")
 */
class Reponse_Formulaire
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
    public $T_Reponse;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    public $N_ID_Utils_Crea;

    /**
     * @ORM\OneToMany(targetEntity="Assoc_Ligne_Formulaires_Reponses",mappedBy="O_Reponses")
     * @ORM\JoinColumn(name="Assoc_Ligne_Formulaires_Reponses",referencedColumnName="Reponse_Formulaire")
     */
    public $O_Ligne_Forms;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    public $D_Crea;
    
    function setReponse($T_data)
    {
        $this->T_Reponse = $T_data;
    }
    function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    function setLignesForms($O_data)
    {
        $this->O_Ligne_Forms = $O_data;
    }
    function setGroups($O_data)
    {
        $this->O_Groups = $O_data;
    }
    function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }

    function getID(){
        return $this->ID;
    }
    function getReponse(){
        return $this->T_Reponse;
    }
    function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    function getLignesForms(){
        return $this->O_Ligne_Forms;
    }
    function getGroups(){
        return $this->O_Groups;
    }
    function getDateCrea(){
        return $this->D_Crea;
    }
}