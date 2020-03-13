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
    private $ID;

    /**
     * @ORM\Column(name="t_titre",type="string", nullable=true)
     */
    private $T_Titre;

    /**
     * @ORM\Column(name="n_ordre", type="integer", nullable=true)
     */
    private $N_Ordre;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    private $N_ID_Utils_Crea;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ligne_Formulaire",inversedBy="O_Inline")
     * @ORM\JoinColumn(name="Ligne_Formulaire",referencedColumnName="id")
     */
    private $O_Ligne;

    /**
     * @ORM\Column(name="d_crea",type="date", nullable=false)
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
    public function setOrdre($N_data)
    {
        $this->N_Ordre = (($N_data > 0) ? -$N_data : $N_data);
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    public function setLigne($O_data)
    {
        $this->O_Ligne = $O_data;
    }

    public function getID()
    {
        return $this->ID;
    }
    public function getLigne()
    {
        return $this->O_Ligne;
    }
    public function getTitre()
    {
        return $this->T_Titre;
    }
    public function getIdUtilsCrea()
    {
        return $this->N_ID_Utils_Crea;
    }
    public function getOrdre()
    {
        return $this->N_Ordre;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
}