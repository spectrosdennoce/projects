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
    private $ID;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $T_Reponse;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    private $N_ID_Utils_Crea;

    /**
     * @ORM\OneToOne(targetEntity="Assoc_Ligne_Formulaires_Reponses",mappedBy="O_Reponses")
     */
    private $O_Ligne_Forms;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $D_Crea;
    
    public function setReponse($T_data)
    {
        $this->T_Reponse = $T_data;
    }
    public function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    public function setLignesForms($O_data)
    {
        $this->O_Ligne_Forms = $O_data;
    }
    public function setGroups($O_data)
    {
        $this->O_Groups = $O_data;
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }

    public function getID(){
        return $this->ID;
    }
    public function getReponse(){
        return $this->T_Reponse;
    }
    public function getIdUtilsCrea(){
        return $this->N_ID_Utils_Crea;
    }
    public function getLignesForms(){
        return $this->O_Ligne_Forms;
    }
    public function getGroups(){
        return $this->O_Groups;
    }
    public function getDateCrea(){
        return $this->D_Crea;
    }
}