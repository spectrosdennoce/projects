<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Assoc_Utilisateurs_Groups")
 */
class Assoc_Utilisateurs_Groups
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $ID;

    /**
     * @ORM\ManyToOne(targetEntity="Groups")
     * @ORM\JoinColumn(name="N_ID_Groups",referencedColumnName="id")
     */
    public $N_ID_Groups;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils",referencedColumnName="id")
     */
    public $N_ID_Utils;

    /**
     * @ORM\ManyToOne(targetEntity="Utils")
     * @ORM\JoinColumn(name="N_ID_Utils_Crea",referencedColumnName="id")
     */
    public $N_ID_Utils_Crea;

    /**
     * @ORM\Column(type="boolean")
     */
    public $B_Deleguer;

    /**
     * @ORM\Column(type="date")
     */
    public $D_Crea;

    /**
     * @ORM\Column(type="date")
     */
    public $D_Dele;
}