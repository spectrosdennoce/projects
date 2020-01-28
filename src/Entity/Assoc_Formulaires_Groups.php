<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Assoc_Formulaires_Groups")
 */
class Assoc_Formulaires_Groups
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Formulaire",inversedBy="O_Groups")
     * @ORM\JoinColumn(name="Formulaire",referencedColumnName="id")
     */
    public $N_ID_Formulaires;

    /**
     * @ORM\ManyToOne(targetEntity="Groups",inversedBy="O_Forms")
     * @ORM\JoinColumn(name="Groups",referencedColumnName="id")
     */
    public $N_ID_Groups;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id")
     */
    public $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="date")
     */
    public $D_Crea;
    
    /**
     * @ORM\Column(type="date")
     */
    public $D_Dele;
    
    /**
     * @ORM\Column(type="boolean")
     */
    public $B_Visible;

    public function __construct(){
        $this->N_ID_Formulaires = new ArrayCollection();
    }
}