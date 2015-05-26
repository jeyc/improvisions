<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BaremeIR
 *
 * @ORM\Table("improvisions_ir_bareme")
 * @ORM\Entity
 */
class BaremeIR
{

    const DEFAULT_TRANCHES_NUMBER = 5;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var TrancheIR[]
     * @ORM\OneToMany(
     *  targetEntity="TrancheIR",
     *  mappedBy="bareme",
     *  cascade={"all"}
     *  )
     */
    private $tranches;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return BaremeIR
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tranches = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tranche
     *
     * @param \AppBundle\Entity\TrancheIR $tranche
     * @return BaremeIR
     */
    public function addTranche(\AppBundle\Entity\TrancheIR $tranche)
    {
        $this->tranches[$tranche->getMin()] = $tranche;
        $tranche->setBareme($this);

        return $this;
    }

    /**
     * Remove tranche
     *
     * @param \AppBundle\Entity\TrancheIR $tranche
     */
    public function removeTranche(\AppBundle\Entity\TrancheIR $tranche)
    {
        $this->tranches->removeElement($tranche);

        return $this;
    }

    /**
     * Get tranches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTranches()
    {
        return $this->tranches;
    }

}
