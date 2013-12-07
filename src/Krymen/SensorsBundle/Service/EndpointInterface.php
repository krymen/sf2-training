<?php

namespace Krymen\SensorsBundle\Service;

interface EndpointInterface
{
    public function notify($msg);
}
