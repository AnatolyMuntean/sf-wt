<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VehicleType
 *
 * @ORM\Table(name="vehicle_types")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VehicleTypesRepository")
 */
class VehicleType
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation", type="string", unique=true)
     */
    private $abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Tank
     *
     * @ORM\OneToMany(targetEntity="Tank", mappedBy="type")
     */
    private $tanks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tanks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return VehicleType
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
     * Set abbreviation
     *
     * @param string $abbreviation
     *
     * @return VehicleType
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * Get abbreviation
     *
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return VehicleType
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

    /**
     * Add tank
     *
     * @param \AppBundle\Entity\Tank $tank
     *
     * @return VehicleType
     */
    public function addTank(\AppBundle\Entity\Tank $tank)
    {
        $this->tanks[] = $tank;

        return $this;
    }

    /**
     * Remove tank
     *
     * @param \AppBundle\Entity\Tank $tank
     */
    public function removeTank(\AppBundle\Entity\Tank $tank)
    {
        $this->tanks->removeElement($tank);
    }

    /**
     * Get tanks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTanks()
    {
        return $this->tanks;
    }
}
