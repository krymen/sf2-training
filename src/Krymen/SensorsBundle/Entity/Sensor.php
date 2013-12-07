<?php

namespace Krymen\SensorsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Sensor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Krymen\SensorsBundle\Entity\SensorRepository")
 * @ExclusionPolicy("all")
 */
class Sensor
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
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
     * @Expose
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
     * @Expose
     **/
    private $samples;

    public function __construct($id, $name, $type, $description = '')
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

    public function addSample($value)
    {
        $sample = new Sample($value);
        $this->samples->add($sample);

        return $sample;
    }
}
