<?php

namespace Krymen\SensorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KrymenSensorsBundle:Default:index.html.twig', array('name' => $name));
    }
}
