<?php

namespace Krymen\SensorsBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Krymen\SensorsBundle\Entity\SampleEvent;
use Krymen\SensorsBundle\Entity\Sensor;
use Krymen\SensorsBundle\Entity\SensorRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SensorManager implements SensorManagerInterface
{
    /**
     * @var \Krymen\SensorsBundle\Entity\SensorRepositoryInterface
     */
    private $repository;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $objectManager;
    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(SensorRepositoryInterface $repository, ObjectManager $objectManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->repository = $repository;
        $this->objectManager = $objectManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createSensor($name, $uid, $type)
    {
        $sensor = new Sensor($name, $uid, $type);
        $this->repository->add($sensor);
        $this->objectManager->flush();

        return $sensor;
    }

    public function deleteSensor(Sensor $sensor)
    {
        $this->repository->remove($sensor);
        $this->objectManager->flush();
    }

    public function retrieveSensors()
    {
        return $this->repository->findAll();
    }

    public function retrieveSensor($uid)
    {
        return $this->repository->find($uid);
    }

    public function storeSample(Sensor $sensor, $value)
    {
        $sample = $sensor->addSample($value);

        $this->objectManager->flush();
        $this->eventDispatcher->dispatch('krymen_sensors.sample.store', new SampleEvent($sample));
    }
}
