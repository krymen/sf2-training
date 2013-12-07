<?php

namespace Krymen\SensorsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sensor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Krymen\SensorsBundle\Entity\SensorRepository")
 */
class Sensor
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30)
     */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Sample", cascade={ "persist", "remove" })
     * @ORM\JoinTable(name="sensors__samples",
     *      joinColumns={@ORM\JoinColumn(name="sensor_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="sample_id", referencedColumnName="id", unique=true)}
     * )
     **/
    private $samples;

    public function __construct($id, $name, $description, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->samples = new ArrayCollection();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Sensor
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set description
     *
     * @param string $description
     *
     * @return Sensor
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Sensor
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function addSample(\DateTime $date, $value)
    {
        $sensor = new Sample($date, $value);
        $this->samples->add($sensor);

        return $sensor;
    }
}
