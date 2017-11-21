<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vendor
 *
 * @ORM\Table(name="vendor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VendorRepository")
 */
class Vendor
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
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var Engine[]
     *
     * @ORM\OneToMany(targetEntity="Engine", mappedBy="vendor")
     */
    private $engines;

    /**
     * @var Gun[]
     *
     * @ORM\OneToMany(targetEntity="Gun", mappedBy="vendor")
     */
    private $guns;

    /**
     * @var Tank[]
     *
     * @ORM\OneToMany(targetEntity="Tank", mappedBy="vendor")
     */
    private $tanks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->engines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->guns = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set country
     *
     * @param string $country
     *
     * @return Vendor
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add engine
     *
     * @param \AppBundle\Entity\Engine $engine
     *
     * @return Vendor
     */
    public function addEngine(\AppBundle\Entity\Engine $engine)
    {
        $this->engines[] = $engine;

        return $this;
    }

    /**
     * Remove engine
     *
     * @param \AppBundle\Entity\Engine $engine
     */
    public function removeEngine(\AppBundle\Entity\Engine $engine)
    {
        $this->engines->removeElement($engine);
    }

    /**
     * Get engines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEngines()
    {
        return $this->engines;
    }

    /**
     * Add gun
     *
     * @param \AppBundle\Entity\Gun $gun
     *
     * @return Vendor
     */
    public function addGun(\AppBundle\Entity\Gun $gun)
    {
        $this->guns[] = $gun;

        return $this;
    }

    /**
     * Remove gun
     *
     * @param \AppBundle\Entity\Gun $gun
     */
    public function removeGun(\AppBundle\Entity\Gun $gun)
    {
        $this->guns->removeElement($gun);
    }

    /**
     * Get guns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuns()
    {
        return $this->guns;
    }

    /**
     * Add tank
     *
     * @param \AppBundle\Entity\Tank $tank
     *
     * @return Vendor
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
