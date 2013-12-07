<?php


namespace Krymen\SensorsBundle\DataFixtures\ORM;


namespace Acme\HelloBundle\DataFixtures\ORM;

use Acme\HelloBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Krymen\SensorsBundle\Entity\Sensor;

class SensorFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        foreach (range(1, 100) as $s) {
            $sensor = new Sensor(
                $faker->uuid,
                $faker->name,
                $faker->text(100),
                $faker->randomElement(array('temperature', 'humidity'))
            );

            foreach (range(1, 10) as $sa) {
                $sensor->addSample($faker->dateTimeThisYear, $faker->randomFloat);
            }

            $manager->persist($sensor);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 100;
    }


}
