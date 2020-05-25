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
    private $ID;

    /**
     * @ORM\Column(type="string", nullable=true, name="t_titre")
     */
    private $T_Titre;

    /**
     * @ORM\Column(type="boolean", nullable=true, name="b_obligation")
     */
    private $B_Obligation;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true, name="t_slug")
     */
    private $T_Slug;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true, name="t_slug_view")
     */
    private $T_Slug_View;

    /**
     * @ORM\OneToMany(targetEntity="Assoc_Formulaires_Groups",mappedBy="N_ID_Formulaires")
     */
    private $O_Groups;

    /**
     * @ORM\OneToMany(targetEntity="Ligne_Formulaire",mappedBy="N_ID_Formulaires")
     * @ORM\JoinColumn(name="Ligne_Formulaire",referencedColumnName="id")
     * @ORM\OrderBy({"N_Ordre" = "ASC"})
     */
    private $O_Ligne;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id", nullable=false)
     */
    private $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="date", nullable=false, name="d_crea")
     */
    private $D_Crea;

    /**
     * @ORM\Column(type="date", nullable=true, name="d_vali")
     */
    private $D_Vali;
    
    /**
     * @ORM\Column(type="date", nullable=true, name="d_dele")
     */
    private $D_Dele;
    
    /**
     * @ORM\Column(type="boolean", nullable=false, name="b_visible")
     */
    private $B_Visible;

    /**
     * @ORM\Column(type="boolean", nullable=false, name="b_valide")
     */
    private $B_Valide;

    public function setTitre($T_data)
    {
        $this->T_Titre = $T_data;
    }
    public function setObligation($B_data)
    {
        $this->B_Obligation = $B_data;
    }
    public function setIdUtilsCrea($N_data)
    {
        $this->N_ID_Utils_Crea = $N_data;
    }
    public function setGroups($O_data)
    {
        $this->O_Groups = $O_data;
    }
    public function setLigne($O_data)
    {
        $this->O_Ligne = $O_data;
    }
    public function setDateCrea($D_data)
    {
        $this->D_Crea = new \DateTime($D_data);
    }
    public function setDateVali($D_data)
    {
        $this->D_Vali = new \DateTime($D_data);
    }
    public function setDateDele($D_data)
    {
        $this->D_Dele = new \DateTime($D_data);
    }
    public function setVisible($B_data)
    {
        $this->B_Visible = $B_data;
    }
    public function setValide($B_data)
    {
        $this->B_Valide = $B_data;
    }
    public function setSlug($T_data)
    {
        $this->T_Slug = $T_data;
    }
    public function setSlugView($T_data)
    {
        $this->T_Slug_View = $T_data;
    }

    public function getID()
    {
        return $this->ID;
    }
    public function getObligation()
    {
        return $this->B_Obligation;
    }
    public function getTitre()
    {
        return $this->T_Titre;
    }
    public function getGroups()
    {
        return $this->O_Groups;
    }
    public function getLigne()
    {
        return $this->O_Ligne;
    }
    public function getIdUtilsCrea()
    {
        return $this->N_ID_Utils_Crea;
    }
    public function getDateCrea()
    {
        return $this->D_Crea;
    }
    public function getDateVali()
    {
        return $this->D_Vali;
    }
    public function getDateDele()
    {
        return $this->D_Dele;
    }
    public function getVisible()
    {
        return $this->B_Visible;
    }
    public function getValide()
    {
        return $this->B_Valide;
    }
    public function getSlug()
    {
        return $this->T_Slug;
    }
    public function getSlugView()
    {
        return $this->T_Slug_View;
    }
}