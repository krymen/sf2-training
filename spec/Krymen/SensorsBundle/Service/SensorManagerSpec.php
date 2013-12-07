<?php

namespace spec\Krymen\SensorsBundle\Service;

use Krymen\SensorsBundle\Entity\Sample;
use Krymen\SensorsBundle\Entity\Sensor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SensorManagerSpec extends ObjectBehavior
{
    /**
     * @param Krymen\SensorsBundle\Entity\SensorRepositoryInterface $repository
     * @param Doctrine\Common\Persistence\ObjectManager             $objectManager
     * @param Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
     */
    function let($repository, $objectManager, $eventDispatcher)
    {
        $this->beConstructedWith($repository, $objectManager, $eventDispatcher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Krymen\SensorsBundle\Service\SensorManager');
    }

    function it_should_create_sensor($repository, $objectManager)
    {
        $name = 'sample sensor';
        $uid  = 'abc230-322-csd22';
        $type = 'temperature';

        $sensor = new Sensor($name, $uid, $type);

        $this->createSensor($name, $uid, $type)->shouldBeLike($sensor);

        $repository->add(Argument::type('Krymen\SensorsBundle\Entity\Sensor'))->shouldHaveBeenCalled();
        $objectManager->flush()->shouldHaveBeenCalled();
    }

    function it_should_delete_sensor($repository, $objectManager)
    {
        $sensor = new Sensor('a', '123-34', 'temperature');

        $this->deleteSensor($sensor);

        $repository->remove($sensor)->shouldHaveBeenCalled();
        $objectManager->flush()->shouldHaveBeenCalled();
    }

    function it_should_retrieve_sensors($repository)
    {
        $sensors = array(
            new Sensor('a', '123', 'temperature'),
            new Sensor('b', '321', 'humidity'),
            new Sensor('c', '40', 'humidity'),
        );

        $repository->findAll()->willReturn($sensors);

        $this->retrieveSensors()->shouldBe($sensors);
    }

    function it_should_retrieve_sensor($repository)
    {
        $uid = 'a';
        $sensor = new Sensor($uid, '123', 'temperature');

        $repository->find($uid)->willReturn($sensor);

        $this->retrieveSensor($uid)->shouldBe($sensor);
    }

    function it_should_store_sample($eventDispatcher, $objectManager)
    {
        $sensor = new Sensor('a', '123', 'temperature');

        $this->storeSample($sensor, 123.21);

        $eventDispatcher->dispatch('krymen_sensors.sample.store', Argument::type('Krymen\SensorsBundle\Entity\SampleEvent'))->shouldHaveBeenCalled();
        $objectManager->flush()->shouldBeCalled();
    }
}
