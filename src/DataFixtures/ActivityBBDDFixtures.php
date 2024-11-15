<?php

// src/DataFixtures/ActivityBBDDFixtures.php

namespace App\DataFixtures;

use App\Entity\ActivityBBDD;
use App\Entity\Subcategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActivityBBDDFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $activities = [
            ['name' => 'Via Ferrata Cuenca', 'subcategory' => 'Via Ferrata'],
            ['name' => 'Senderismo Pirineos', 'subcategory' => 'Senderismo'],
            ['name' => 'Kayak Río Sella', 'subcategory' => 'Kayak'],
            ['name' => 'Buceo Isla Palma', 'subcategory' => 'Buceo'],
        ];

        foreach ($activities as $activityData) {
            $subcategory = $manager->getRepository(Subcategory::class)->findOneBy(['name_sub' => $activityData['subcategory']]);
            if ($subcategory) {
                $activity = new ActivityBBDD();
                $activity->setName($activityData['name']);
                $activity->setSubcategory($subcategory);
                $manager->persist($activity);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SubcategoryFixtures::class,
        ];
    }
}

