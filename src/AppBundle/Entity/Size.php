<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Size
 *
 * @ORM\Table(name="sizes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SizeRepository")
 */
class Size
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
     * @ORM\OneToMany(targetEntity="Tank", mappedBy="size")
     */
    private $tank;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer")
     * @Assert\GreaterThan(0)
     */
    private $height;

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer")
     * @Assert\GreaterThan(0)
     */
    private $width;

    /**
     * @var integer
     *
     * @ORM\Column(name="length", type="integer")
     * @Assert\GreaterThan(0)
     */
    private $length;

    /**
     * @var integer
     *
     * @ORM\Column(name="length_w_gun", type="integer")
     */
    private $lengthWithGun;

    /**
     * @var integer
     *
     * @ORM\Column(name="clearance", type="integer")
     * @Assert\GreaterThan(0)
     */
    private $clearance;

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
     * Set height
     *
     * @param integer $height
     *
     * @return Size
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return Size
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set length
     *
     * @param integer $length
     *
     * @return Size
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set lengthWithGun
     *
     * @param integer $lengthWithGun
     *
     * @return Size
     */
    public function setLengthWithGun($lengthWithGun)
    {
        $this->lengthWithGun = $lengthWithGun;

        return $this;
    }

    /**
     * Get lengthWithGun
     *
     * @return integer
     */
    public function getLengthWithGun()
    {
        return $this->lengthWithGun;
    }

    /**
     * Set clearance
     *
     * @param integer $clearance
     *
     * @return Size
     */
    public function setClearance($clearance)
    {
        $this->clearance = $clearance;

        return $this;
    }

    /**
     * Get clearance
     *
     * @return integer
     */
    public function getClearance()
    {
        return $this->clearance;
    }

    /**
     * Add tank
     *
     * @param \AppBundle\Entity\Tank $tank
     *
     * @return Size
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
}
