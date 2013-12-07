<?php

namespace Krymen\SensorsBundle\Controller;

use Krymen\SensorsBundle\Entity\Sensor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;

class SensorsController extends Controller
{
    /**
     * @View()
     */
    public function getSensorsAction()
    {
        return $this->getService()->retrieveSensors();
    }

    /**
     * @View()
     */
    public function getSensorAction($uid)
    {
        return $this->getService()->retrieveSensor($uid);
    }

    /**
     * @View()
     */
    public function postSensorSamplesAction(Sensor $sensor, Request $request)
    {
        $this->getService()->storeSample($sensor, $request->request->get('value'));
    }

    private function getService()
    {
        return $this->get('krymen_sensors.service');
    }
}
