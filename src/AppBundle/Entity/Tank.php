<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tank
 *
 * @ORM\Table(name="tanks")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TankRepository")
 */
class Tank implements UploadableInterface
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
     * @var Size
     *
     * @ORM\ManyToOne(targetEntity="Size", inversedBy="tank", cascade="persist")
     * @Assert\Valid
     */
    private $size;

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     * @Assert\GreaterThan(0)
     */
    private $weight;

    /**
     * @var Production
     *
     * @ORM\ManyToOne(targetEntity="Production", inversedBy="tank", cascade="persist")
     * @Assert\Valid
     */
    private $production;

    /**
     * @var string
     *
     * @ORM\Column(name="original_name", type="string")
     */
    private $original_name;

    /**
     * @var Engine
     *
     * @ORM\ManyToOne(targetEntity="Engine", inversedBy="tank")
     * @Assert\Valid
     */
    private $engine;

    /**
     * @var ArmorHull
     *
     * @ORM\ManyToOne(targetEntity="ArmorHull", inversedBy="tank");
     */
    private $hull_armor;

    /**
     * @var ArmorTurret
     *
     * @ORM\ManyToOne(targetEntity="ArmorTurret", inversedBy="tank");
     */
    private $turret_armor;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private $image;

    /**
     * @var File
     *
     * @Assert\Image()
     */
    private $imageFile;

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
     * Set weight
     *
     * @param integer $weight
     *
     * @return Tank
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set originalName
     *
     * @param string $originalName
     *
     * @return Tank
     */
    public function setOriginalName($originalName)
    {
        $this->original_name = $originalName;

        return $this;
    }

    /**
     * Get originalName
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->original_name;
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

    /**
     * Set size
     *
     * @param \AppBundle\Entity\Size $size
     *
     * @return Tank
     */
    public function setSize(\AppBundle\Entity\Size $size = null)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return \AppBundle\Entity\Size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set production
     *
     * @param \AppBundle\Entity\Production $production
     *
     * @return Tank
     */
    public function setProduction(\AppBundle\Entity\Production $production = null)
    {
        $this->production = $production;

        return $this;
    }

    /**
     * Get production
     *
     * @return \AppBundle\Entity\Production
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**
     * Add engine
     *
     * @param \AppBundle\Entity\Engine $engine
     *
     * @return Tank
     */
    public function setEngine(\AppBundle\Entity\Engine $engine)
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * Get engine
     *
     * @return \AppBundle\Entity\Engine
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Set hullArmor
     *
     * @param \AppBundle\Entity\ArmorHull $hullArmor
     *
     * @return Tank
     */
    public function setHullArmor(\AppBundle\Entity\ArmorHull $hullArmor = null)
    {
        $this->hull_armor = $hullArmor;

        return $this;
    }

    /**
     * Get hullArmor
     *
     * @return \AppBundle\Entity\ArmorHull
     */
    public function getHullArmor()
    {
        return $this->hull_armor;
    }

    /**
     * Set turretArmor
     *
     * @param \AppBundle\Entity\ArmorTurret $turretArmor
     *
     * @return Tank
     */
    public function setTurretArmor(\AppBundle\Entity\ArmorTurret $turretArmor = null)
    {
        $this->turret_armor = $turretArmor;

        return $this;
    }

    /**
     * Get turretArmor
     *
     * @return \AppBundle\Entity\ArmorTurret
     */
    public function getTurretArmor()
    {
        return $this->turret_armor;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tank
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
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param File $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
}
