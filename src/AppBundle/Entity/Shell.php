<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Shell
 *
 * @ORM\Table(name="shell")
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
     * @var Penetration
     *
     * @ORM\OneToMany(targetEntity="Penetration", mappedBy="shell")
     */
    private $penetration_data;

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
     * Constructor
     */
    public function __construct()
    {
        $this->penetration_data = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add penetrationDatum
     *
     * @param \AppBundle\Entity\Penetration $penetrationDatum
     *
     * @return Shell
     */
    public function addPenetrationDatum(\AppBundle\Entity\Penetration $penetrationDatum)
    {
        $this->penetration_data[] = $penetrationDatum;

        return $this;
    }

    /**
     * Remove penetrationDatum
     *
     * @param \AppBundle\Entity\Penetration $penetrationDatum
     */
    public function removePenetrationDatum(\AppBundle\Entity\Penetration $penetrationDatum)
    {
        $this->penetration_data->removeElement($penetrationDatum);
    }

    /**
     * Get penetrationData
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPenetrationData()
    {
        return $this->penetration_data;
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
