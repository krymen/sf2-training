<?php

namespace Krymen\SensorsBundle\Entity;

use Symfony\Component\EventDispatcher\Event;

class SampleEvent extends Event
{
    /**
     * @var Sample
     */
    private $sample;

    public function __construct(Sample $sample)
    {
        $this->sample = $sample;
    }

    public function getSampleValue()
    {
        return $this->sample->getValue();
    }
}
