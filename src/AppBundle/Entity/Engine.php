<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Engine
 *
 * @ORM\Table(name="engines")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EngineRepository")
 */
class Engine
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
     * @ORM\ManyToMany(targetEntity="Tank", mappedBy="engines")
     */
    private $tank;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="horsepower", type="integer")
     * @Assert\GreaterThan(0)
     */
    private $horsepower;

    /**
     * @var integer
     *
     * @ORM\Column(name="displacement", type="integer")
     * @Assert\GreaterThan(0)
     */
    private $displacement;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=4)
     */
    private $type;

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
     * @return Engine
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
     * Set horsepower
     *
     * @param integer $horsepower
     *
     * @return Engine
     */
    public function setHorsepower($horsepower)
    {
        $this->horsepower = $horsepower;

        return $this;
    }

    /**
     * Get horsepower
     *
     * @return integer
     */
    public function getHorsepower()
    {
        return $this->horsepower;
    }

    /**
     * Set displacement
     *
     * @param integer $displacement
     *
     * @return Engine
     */
    public function setDisplacement($displacement)
    {
        $this->displacement = $displacement;

        return $this;
    }

    /**
     * Get displacement
     *
     * @return integer
     */
    public function getDisplacement()
    {
        return $this->displacement;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Engine
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add tank
     *
     * @param \AppBundle\Entity\Tank $tank
     *
     * @return Engine
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
     * Set description
     *
     * @param string $description
     *
     * @return Engine
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
