<?php

namespace Krymen\SensorsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SensorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SensorRepository extends EntityRepository implements SensorRepositoryInterface
{
    public function add(Sensor $sensor)
    {
        $this->_em->persist($sensor);
    }

    public function remove(Sensor $sensor)
    {
        $this->_em->remove($sensor);
    }

}
