<?php

// src/DataFixtures/SubcategoryFixtures.php

namespace App\DataFixtures;

use App\Entity\Subcategory;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SubcategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            'Via Ferrata' => 'Montaña',
            'Senderismo' => 'Montaña',
            'Kayak' => 'Acuática',
            'Buceo' => 'Acuática',
        ];

        foreach ($categories as $subName => $catName) {
            $category = $manager->getRepository(Category::class)->findOneBy(['name_cat' => $catName]);
            if ($category) {
                $subcategory = new Subcategory();
                $subcategory->setNameSub($subName);
                $subcategory->setCategory($category);
                $manager->persist($subcategory);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}

