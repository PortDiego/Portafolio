<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCES = [
        'montana' => 'Montaña',
        'agua' => 'Agua',
        'nieve' => 'Nieve'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORY_REFERENCES as $key => $name) {
            $category = new Category();
            $category->setNameCat($name);
            $manager->persist($category);

            // Almacena una referencia para usar en el fixture de Subcategory
            $this->addReference($key, $category);
        }

        $manager->flush();
    }
}