<?php

// src/DataFixtures/CategoryFixtures.php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = ['Montaña', 'Acuática'];

        foreach ($categories as $name) {
            $category = new Category();
            $category->setNameCat($name);
            $category->setActive(true);
            $manager->persist($category);
        }

        $manager->flush();
    }
}

