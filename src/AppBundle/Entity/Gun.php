<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Gun
 *
 * @ORM\Table(name="guns")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GunRepository")
 */
class Gun
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var Tank
     *
     * @ORM\ManyToMany(targetEntity="Tank", mappedBy="guns")
     */
    private $tank;

    /**
     * @var string
     *
     * @ORM\Column(name="shell", type="string", length=255)
     */
    private $shell;

    /**
     * @var integer
     *
     * @ORM\Column(name="caliber", type="integer")
     */
    private $caliber;

    /**
     * @var float
     *
     * @ORM\Column(name="elevation_min", type="float")
     */
    private $elevation_min;

    /**
     * @var float
     *
     * @ORM\Column(name="elevation_max", type="float")
     */
    private $elevation_max;

    /**
     * @var integer
     *
     * @ORM\Column(name="traverse", type="integer")
     * @Assert\Range(min=0, max=360)
     */
    private $traverse;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tank = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Gun
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add tank
     *
     * @param \AppBundle\Entity\Tank $tank
     *
     * @return Gun
     */
    public function addTank(\AppBundle\Entity\Tank $tank)
    {
        $this->tank[] = $tank;

        return $this;
    }

    /**
     * Remove tank
     *
     * @param \AppBundle\Entity\Tank $tank
     */
    public function removeTank(\AppBundle\Entity\Tank $tank)
    {
        $this->tank->removeElement($tank);
    }

    /**
     * Get tank
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTank()
    {
        return $this->tank;
    }

    /**
     * Set shell
     *
     * @param string $shell
     *
     * @return Gun
     */
    public function setShell($shell)
    {
        $this->shell = $shell;

        return $this;
    }

    /**
     * Get shell
     *
     * @return string
     */
    public function getShell()
    {
        return $this->shell;
    }

    /**
     * Set caliber
     *
     * @param integer $caliber
     *
     * @return Gun
     */
    public function setCaliber($caliber)
    {
        $this->caliber = $caliber;

        return $this;
    }

    /**
     * Get caliber
     *
     * @return integer
     */
    public function getCaliber()
    {
        return $this->caliber;
    }

    /**
     * Set elevationMin
     *
     * @param float $elevationMin
     *
     * @return Gun
     */
    public function setElevationMin($elevationMin)
    {
        $this->elevation_min = $elevationMin;

        return $this;
    }

    /**
     * Get elevationMin
     *
     * @return float
     */
    public function getElevationMin()
    {
        return $this->elevation_min;
    }

    /**
     * Set elevationMax
     *
     * @param float $elevationMax
     *
     * @return Gun
     */
    public function setElevationMax($elevationMax)
    {
        $this->elevation_max = $elevationMax;

        return $this;
    }

    /**
     * Get elevationMax
     *
     * @return float
     */
    public function getElevationMax()
    {
        return $this->elevation_max;
    }

    /**
     * Set traverse
     *
     * @param integer $traverse
     *
     * @return Gun
     */
    public function setTraverse($traverse)
    {
        $this->traverse = $traverse;

        return $this;
    }

    /**
     * Get traverse
     *
     * @return integer
     */
    public function getTraverse()
    {
        return $this->traverse;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Gun
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
