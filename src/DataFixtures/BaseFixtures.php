<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixtures extends Fixture
{
    /** @var ObjectManager */
    private $manager;

    /** @var Generator */
    protected $faker;

    private $referencesIndex = [];

    abstract protected function loadData(ObjectManager $manager);

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->manager = $manager;
        $this->faker = Factory::create();

        $this->loadData($manager);
    }

    /**
     * @param int $count
     * @param string $groupName
     * @param callable $factory
     */
    protected function createMany (int $count, string $groupName, callable $factory)
    {
        for($i = 0; $i < $count; $i++) {
            $entity = $factory($i);

            if(null === $entity) {
                throw new \LogicException('Вы не забыли вернуть сущность с вашей функцией обратного вызова createMany?');

            }

            $this->manager->persist($entity);

            $this->addReference(sprintf('%s_%d', $groupName, $i), $entity);
        }

    }

}
