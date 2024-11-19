<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\DependencyInjection\Attribute\When;

#[When("test")]
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
            // Verificar si la categoría ya existe para evitar duplicados
            $existingCategory = $manager->getRepository(Category::class)->findOneBy(['name_cat' => $name]);

            if (!$existingCategory) {
                // Si no existe, crear una nueva categoría
                $category = new Category();
                $category->setNameCat($name);
                $manager->persist($category);

                // Almacena una referencia para usar en otros fixtures
                $this->addReference($key, $category);
            }
        }

        // Guardar los datos persistidos
        $manager->flush();
    }
}
