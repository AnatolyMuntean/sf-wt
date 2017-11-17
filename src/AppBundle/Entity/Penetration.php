<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Penetration
 *
 * @ORM\Table(name="penetration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PenetrationRepository")
 */
class Penetration
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Shell", inversedBy="penetration_data")
     */
    private $shell;

    /**
     * @ORM\ManyToOne(targetEntity="Gun", inversedBy="penetration_data")
     */
    private $gun;

    /**
     * @var integer
     *
     * @ORM\Column(name="at_100", type="integer")
     */
    private $at_100;

    /**
     * @var integer
     *
     * @ORM\Column(name="at_250", type="integer")
     */
    private $at_250;

    /**
     * @var integer
     *
     * @ORM\Column(name="at_500", type="integer")
     */
    private $at_500;

    /**
     * @var integer
     *
     * @ORM\Column(name="at_1000", type="integer")
     */
    private $at_1000;

    /**
     * @var integer
     *
     * @ORM\Column(name="at_2000", type="integer")
     */
    private $at_2000;

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
     * Set shell
     *
     * @param \AppBundle\Entity\Shell $shell
     *
     * @return Penetration
     */
    public function setShell(\AppBundle\Entity\Shell $shell = null)
    {
        $this->shell = $shell;

        return $this;
    }

    /**
     * Get shell
     *
     * @return \AppBundle\Entity\Shell
     */
    public function getShell()
    {
        return $this->shell;
    }

    /**
     * Set gun
     *
     * @param \AppBundle\Entity\Gun $gun
     *
     * @return Penetration
     */
    public function setGun(\AppBundle\Entity\Gun $gun = null)
    {
        $this->gun = $gun;

        return $this;
    }

    /**
     * Get gun
     *
     * @return \AppBundle\Entity\Gun
     */
    public function getGun()
    {
        return $this->gun;
    }

    /**
     * Set at100
     *
     * @param integer $at100
     *
     * @return Penetration
     */
    public function setAt100($at100)
    {
        $this->at_100 = $at100;

        return $this;
    }

    /**
     * Get at100
     *
     * @return integer
     */
    public function getAt100()
    {
        return $this->at_100;
    }

    /**
     * Set at250
     *
     * @param integer $at250
     *
     * @return Penetration
     */
    public function setAt250($at250)
    {
        $this->at_250 = $at250;

        return $this;
    }

    /**
     * Get at250
     *
     * @return integer
     */
    public function getAt250()
    {
        return $this->at_250;
    }

    /**
     * Set at500
     *
     * @param integer $at500
     *
     * @return Penetration
     */
    public function setAt500($at500)
    {
        $this->at_500 = $at500;

        return $this;
    }

    /**
     * Get at500
     *
     * @return integer
     */
    public function getAt500()
    {
        return $this->at_500;
    }

    /**
     * Set at1000
     *
     * @param integer $at1000
     *
     * @return Penetration
     */
    public function setAt1000($at1000)
    {
        $this->at_1000 = $at1000;

        return $this;
    }

    /**
     * Get at1000
     *
     * @return integer
     */
    public function getAt1000()
    {
        return $this->at_1000;
    }

    /**
     * Set at2000
     *
     * @param integer $at2000
     *
     * @return Penetration
     */
    public function setAt2000($at2000)
    {
        $this->at_2000 = $at2000;

        return $this;
    }

    /**
     * Get at2000
     *
     * @return integer
     */
    public function getAt2000()
    {
        return $this->at_2000;
    }
}
