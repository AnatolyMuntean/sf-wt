<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Gun
 *
 * @ORM\Table(name="guns")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GunRepository")
 */
class Gun implements UploadableInterface
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
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var GunPerformance
     *
     * @ORM\OneToMany(targetEntity="GunPerformance", mappedBy="gun")
     */
    private $performance_data;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     * @Assert\File(mimeTypes={"image/jpeg", "image/png"})
     */
    private $image;

    /**
     * @var File
     *
     * @Assert\Image()
     */
    private $imageFile;

    /**
     * @var Shell[]
     *
     * @ORM\ManyToMany(targetEntity="Shell", inversedBy="guns")
     */
    private $ammo;

    /**
     * @var Vendor
     *
     * @ORM\ManyToOne(targetEntity="Vendor", inversedBy="guns")
     */
    private $vendor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tank = new \Doctrine\Common\Collections\ArrayCollection();
        $this->performance_data = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ammo = new \Doctrine\Common\Collections\ArrayCollection();
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

        // Let Doctrine know that this entity has changed
        // during image upload.
        // This will be anyway overridden in the EventListener.
        if ($imageFile) {
            $this->setImage(md5(uniqid().'.'.$imageFile->guessExtension()));
        }
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

    /**
     * Add ammo
     *
     * @param \AppBundle\Entity\Shell $ammo
     *
     * @return Gun
     */
    public function addAmmo(\AppBundle\Entity\Shell $ammo)
    {
        $this->ammo[] = $ammo;

        return $this;
    }

    /**
     * Remove ammo
     *
     * @param \AppBundle\Entity\Shell $ammo
     */
    public function removeAmmo(\AppBundle\Entity\Shell $ammo)
    {
        $this->ammo->removeElement($ammo);
    }

    /**
     * Get ammo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAmmo()
    {
        return $this->ammo;
    }

    /**
     * Set vendor
     *
     * @param \AppBundle\Entity\Vendor $vendor
     *
     * @return Gun
     */
    public function setVendor(\AppBundle\Entity\Vendor $vendor = null)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return \AppBundle\Entity\Vendor
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Add performanceDatum
     *
     * @param \AppBundle\Entity\GunPerformance $performanceDatum
     *
     * @return Gun
     */
    public function addPerformanceDatum(\AppBundle\Entity\GunPerformance $performanceDatum)
    {
        $this->performance_data[] = $performanceDatum;

        return $this;
    }

    /**
     * Remove performanceDatum
     *
     * @param \AppBundle\Entity\GunPerformance $performanceDatum
     */
    public function removePerformanceDatum(\AppBundle\Entity\GunPerformance $performanceDatum)
    {
        $this->performance_data->removeElement($performanceDatum);
    }

    /**
     * Get performanceData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerformanceData()
    {
        return $this->performance_data;
    }
}
