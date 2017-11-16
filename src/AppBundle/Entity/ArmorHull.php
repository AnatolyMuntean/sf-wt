<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArmorHull
 *
 * @ORM\Table(name="armor_hull")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArmorHullRepository")
 */
class ArmorHull
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
     * @var Tank
     *
     * @ORM\OneToMany(targetEntity="Tank", mappedBy="hull_armor")
     */
    private $tank;

    /**
     * @var integer
     *
     * @ORM\Column(name="front_hi", type="integer")
     */
    private $front_hi;

    /**
     * @var integer
     *
     * @ORM\Column(name="front_hi_angle", type="integer")
     */
    private $front_hi_angle;

    /**
     * @var integer
     *
     * @ORM\Column(name="front_lo", type="integer")
     */
    private $front_lo;

    /**
     * @var integer
     *
     * @ORM\Column(name="front_lo_angle", type="integer")
     */
    private $front_lo_angle;

    /**
     * @var integer
     *
     * @ORM\Column(name="side_hi", type="integer")
     */
    private $side_hi;

    /**
     * @var integer
     *
     * @ORM\Column(name="side_hi_angle", type="integer")
     */
    private $side_hi_angle;

    /**
     * @var integer
     *
     * @ORM\Column(name="side_lo", type="integer")
     */
    private $side_lo;

    /**
     * @var integer
     *
     * @ORM\Column(name="side_lo_angle", type="integer")
     */
    private $side_lo_angle;

    /**
     * @var integer
     *
     * @ORM\Column(name="rear_hi", type="integer")
     */
    private $rear_hi;

    /**
     * @var integer
     *
     * @ORM\Column(name="rear_hi_angle", type="integer")
     */
    private $rear_hi_angle;

    /**
     * @var integer
     *
     * @ORM\Column(name="rear_lo", type="integer")
     */
    private $rear_lo;

    /**
     * @var integer
     *
     * @ORM\Column(name="rear_lo_angle", type="integer")
     */
    private $rear_lo_angle;

    /**
     * @var integer
     *
     * @ORM\Column(name="top", type="integer")
     */
    private $top;

    /**
     * @var integer
     *
     * @ORM\Column(name="bottom", type="integer")
     */
    private $bottom;

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
     * Set frontHi
     *
     * @param integer $frontHi
     *
     * @return ArmorHull
     */
    public function setFrontHi($frontHi)
    {
        $this->front_hi = $frontHi;

        return $this;
    }

    /**
     * Get frontHi
     *
     * @return integer
     */
    public function getFrontHi()
    {
        return $this->front_hi;
    }

    /**
     * Set frontHiAngle
     *
     * @param integer $frontHiAngle
     *
     * @return ArmorHull
     */
    public function setFrontHiAngle($frontHiAngle)
    {
        $this->front_hi_angle = $frontHiAngle;

        return $this;
    }

    /**
     * Get frontHiAngle
     *
     * @return integer
     */
    public function getFrontHiAngle()
    {
        return $this->front_hi_angle;
    }

    /**
     * Set frontLo
     *
     * @param integer $frontLo
     *
     * @return ArmorHull
     */
    public function setFrontLo($frontLo)
    {
        $this->front_lo = $frontLo;

        return $this;
    }

    /**
     * Get frontLo
     *
     * @return integer
     */
    public function getFrontLo()
    {
        return $this->front_lo;
    }

    /**
     * Set frontLoAngle
     *
     * @param integer $frontLoAngle
     *
     * @return ArmorHull
     */
    public function setFrontLoAngle($frontLoAngle)
    {
        $this->front_lo_angle = $frontLoAngle;

        return $this;
    }

    /**
     * Get frontLoAngle
     *
     * @return integer
     */
    public function getFrontLoAngle()
    {
        return $this->front_lo_angle;
    }

    /**
     * Set sideHi
     *
     * @param integer $sideHi
     *
     * @return ArmorHull
     */
    public function setSideHi($sideHi)
    {
        $this->side_hi = $sideHi;

        return $this;
    }

    /**
     * Get sideHi
     *
     * @return integer
     */
    public function getSideHi()
    {
        return $this->side_hi;
    }

    /**
     * Set sideHiAngle
     *
     * @param integer $sideHiAngle
     *
     * @return ArmorHull
     */
    public function setSideHiAngle($sideHiAngle)
    {
        $this->side_hi_angle = $sideHiAngle;

        return $this;
    }

    /**
     * Get sideHiAngle
     *
     * @return integer
     */
    public function getSideHiAngle()
    {
        return $this->side_hi_angle;
    }

    /**
     * Set sideLo
     *
     * @param integer $sideLo
     *
     * @return ArmorHull
     */
    public function setSideLo($sideLo)
    {
        $this->side_lo = $sideLo;

        return $this;
    }

    /**
     * Get sideLo
     *
     * @return integer
     */
    public function getSideLo()
    {
        return $this->side_lo;
    }

    /**
     * Set sideLoAngle
     *
     * @param integer $sideLoAngle
     *
     * @return ArmorHull
     */
    public function setSideLoAngle($sideLoAngle)
    {
        $this->side_lo_angle = $sideLoAngle;

        return $this;
    }

    /**
     * Get sideLoAngle
     *
     * @return integer
     */
    public function getSideLoAngle()
    {
        return $this->side_lo_angle;
    }

    /**
     * Set rearHi
     *
     * @param integer $rearHi
     *
     * @return ArmorHull
     */
    public function setRearHi($rearHi)
    {
        $this->rear_hi = $rearHi;

        return $this;
    }

    /**
     * Get rearHi
     *
     * @return integer
     */
    public function getRearHi()
    {
        return $this->rear_hi;
    }

    /**
     * Set rearHiAngle
     *
     * @param integer $rearHiAngle
     *
     * @return ArmorHull
     */
    public function setRearHiAngle($rearHiAngle)
    {
        $this->rear_hi_angle = $rearHiAngle;

        return $this;
    }

    /**
     * Get rearHiAngle
     *
     * @return integer
     */
    public function getRearHiAngle()
    {
        return $this->rear_hi_angle;
    }

    /**
     * Set rearLo
     *
     * @param integer $rearLo
     *
     * @return ArmorHull
     */
    public function setRearLo($rearLo)
    {
        $this->rear_lo = $rearLo;

        return $this;
    }

    /**
     * Get rearLo
     *
     * @return integer
     */
    public function getRearLo()
    {
        return $this->rear_lo;
    }

    /**
     * Set rearLoAngle
     *
     * @param integer $rearLoAngle
     *
     * @return ArmorHull
     */
    public function setRearLoAngle($rearLoAngle)
    {
        $this->rear_lo_angle = $rearLoAngle;

        return $this;
    }

    /**
     * Get rearLoAngle
     *
     * @return integer
     */
    public function getRearLoAngle()
    {
        return $this->rear_lo_angle;
    }

    /**
     * Set top
     *
     * @param integer $top
     *
     * @return ArmorHull
     */
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }

    /**
     * Get top
     *
     * @return integer
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set bottom
     *
     * @param integer $bottom
     *
     * @return ArmorHull
     */
    public function setBottom($bottom)
    {
        $this->bottom = $bottom;

        return $this;
    }

    /**
     * Get bottom
     *
     * @return integer
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * Add tank
     *
     * @param \AppBundle\Entity\Tank $tank
     *
     * @return ArmorHull
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
