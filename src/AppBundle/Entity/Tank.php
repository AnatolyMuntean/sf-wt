<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tank
 *
 * @ORM\Table(name="tanks")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TankRepository")
 */
class Tank
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
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var Gun
     *
     * @ORM\ManyToMany(targetEntity="Gun", inversedBy="tank")
     */
    private $guns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->guns = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tank
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
     * Add gun
     *
     * @param \AppBundle\Entity\Gun $gun
     *
     * @return Tank
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
}
