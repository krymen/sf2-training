<?php

namespace Krymen\SensorsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sample
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Sample
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    function __construct($date, $value)
    {
        $this->date  = $date;
        $this->value = $value;
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
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Sample
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return Sample
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
