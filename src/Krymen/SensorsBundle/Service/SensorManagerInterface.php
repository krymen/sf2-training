<?php

namespace Krymen\SensorsBundle\Service;

use Krymen\SensorsBundle\Entity\Sensor;

interface SensorManagerInterface
{
    public function createSensor($name, $uid, $type);

    public function deleteSensor(Sensor $sensor);

    public function retrieveSensors();

    public function retrieveSensor($uid);

    public function storeSample(Sensor $sensor, $value);
}
