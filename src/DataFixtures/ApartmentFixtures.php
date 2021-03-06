<?php

namespace App\DataFixtures;

use App\Entity\Apartment;
use App\Entity\Building;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\BuildingFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ApartmentFixtures extends AppFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        parent::load($manager);
        
        $this->createMany(Apartment::class, 9, function(Apartment $apartment, int $count) {
            $apartment->setName($this->faker->lastName);
            $apartment->setBuilding($this->getRandomReference(Building::class));
        });

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            BuildingFixtures::class
        );
    }
}
