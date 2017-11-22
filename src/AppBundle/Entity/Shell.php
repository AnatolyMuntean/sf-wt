<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Shell
 *
 * @ORM\Table(name="shells")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShellRepository")
 */
class Shell implements UploadableInterface
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
     * @var string
     *
     * @ORM\Column(name="abbreviation", type="string")
     */
    private $abbreviation;

    /**
     * @var GunPerformance
     *
     * @ORM\OneToMany(targetEntity="GunPerformance", mappedBy="shell")
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
     * @var Gun[]
     *
     * @ORM\ManyToMany(targetEntity="Gun", mappedBy="ammo")
     */
    private $guns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->performance_data = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Shell
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
     * @return Shell
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
     * Add gun
     *
     * @param \AppBundle\Entity\Gun $gun
     *
     * @return Shell
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
     * Add performanceDatum
     *
     * @param \AppBundle\Entity\GunPerformance $performanceDatum
     *
     * @return Shell
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
