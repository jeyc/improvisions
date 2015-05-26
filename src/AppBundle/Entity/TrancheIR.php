<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TrancheIR
 *
 * @ORM\Table("improvisions_ir_tranche")
 * @ORM\Entity
 */
class TrancheIR
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="min", type="integer")
     * @Assert\GreaterThanOrEqual(0)
     */
    private $min;

    /**
     * @var integer
     *
     * @ORM\Column(name="taux", type="integer")
     * @Assert\Range(
     *  min=0,
     *  max=100
     * )
     */
    private $taux;


    /**
     * @var BaremeIR
     * @ORM\ManyToOne(
     *  targetEntity="BaremeIR",
     *  inversedBy="tranches"
     *  )
     * @ORM\JoinColumn(
     *  name="bareme_id",
     *  referencedColumnName="id",
     *  nullable=false,
     *  onDelete="cascade"
     *  )
     */
    private $bareme;

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
     * Set min
     *
     * @param integer $min
     * @return TrancheIR
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return integer 
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set taux
     *
     * @param integer $taux
     * @return TrancheIR
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;

        return $this;
    }

    /**
     * Get taux
     *
     * @return integer 
     */
    public function getTaux()
    {
        return $this->taux;
    }

    /**
     * Set bareme
     *
     * @param \AppBundle\Entity\BaremeIR $bareme
     * @return TrancheIR
     */
    public function setBareme(\AppBundle\Entity\BaremeIR $bareme)
    {
        $this->bareme = $bareme;

        return $this;
    }

    /**
     * Get bareme
     *
     * @return \AppBundle\Entity\BaremeIR 
     */
    public function getBareme()
    {
        return $this->bareme;
    }
}
