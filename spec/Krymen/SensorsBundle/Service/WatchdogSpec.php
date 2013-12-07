<?php

namespace spec\Krymen\SensorsBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WatchdogSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Krymen\SensorsBundle\Service\Watchdog');
    }

    /**
     * @param Krymen\SensorsBundle\Service\EndpointInterface $endpoint
     * @param Krymen\SensorsBundle\Entity\SampleEvent $event
     */
    function it_should_dispatch_when_store_sample($endpoint, $event)
    {
        $value = 1.34;
        $event->getSampleValue()->willReturn($value);

        $this->addEndpoint($endpoint);
        $this->onStoreSample($event);

        $endpoint->notify($value)->shouldHaveBeenCalled();
    }
}
