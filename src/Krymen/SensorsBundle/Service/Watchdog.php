<?php

namespace Krymen\SensorsBundle\Service;

use Krymen\SensorsBundle\Entity\SampleEvent;

class Watchdog
{
    /**
     * @var EndpointInterface[]
     */
    private $endpoints = array();

    public function onStoreSample(SampleEvent $event)
    {
        foreach ($this->endpoints as $endpoint) {
            $endpoint->notify($event->getSampleValue());
        }
    }

    public function addEndpoint(EndpointInterface $endpoint)
    {
        $this->endpoints[] = $endpoint;
    }
}
