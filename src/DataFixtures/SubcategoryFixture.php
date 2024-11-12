<?php

namespace App\DataFixtures;

use App\Entity\Subcategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SubcategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Subcategorías para Montaña
        $this->createSubcategory('Senderismo', 'montana', $manager);
        $this->createSubcategory('Escalada Clasica', 'montana', $manager);
        $this->createSubcategory('Boulder', 'montana', $manager);
        $this->createSubcategory('Escalada Deportiva', 'montana', $manager);
        $this->createSubcategory('Via Ferrata', 'montana', $manager);
        $this->createSubcategory('Escalada Clasica', 'montana', $manager);
        $this->createSubcategory('Paracaidismo', 'montana', $manager);
        $this->createSubcategory('puenting', 'montana', $manager);
        $this->createSubcategory('Alpinismo', 'montana', $manager);

        // Subcategorías para Agua
        $this->createSubcategory('Natación', 'agua', $manager);
        $this->createSubcategory('Surf', 'agua', $manager);
        $this->createSubcategory('PaddelSurf', 'agua', $manager);
        $this->createSubcategory('Kitesurf', 'agua', $manager);
        $this->createSubcategory('Snorkel', 'agua', $manager);
        $this->createSubcategory('Buceo', 'agua', $manager);
        $this->createSubcategory('Barranquismo', 'agua', $manager);
        $this->createSubcategory('Rafting', 'agua', $manager);
        $this->createSubcategory('Piraguismo', 'agua', $manager);

        // Subcategorías para Nieve
        $this->createSubcategory('Esquí', 'nieve', $manager);
        $this->createSubcategory('Snowboard', 'nieve', $manager);
        $this->createSubcategory('Esquí de fondo', 'nieve', $manager);
        $this->createSubcategory('Esquí alpino', 'nieve', $manager);
        $this->createSubcategory('Esquí de travesia', 'nieve', $manager);
        $this->createSubcategory('Freestyle', 'nieve', $manager);
        $this->createSubcategory('Raquetas de nieve', 'nieve', $manager);
        $this->createSubcategory('Escalada en hielo', 'nieve', $manager);

        $manager->flush();
    }

    private function createSubcategory(string $name, string $categoryReference, ObjectManager $manager): void
    {
        $subcategory = new Subcategory();
        $subcategory->setName($name);

        // Obtiene la categoría asociada usando la referencia
        $category = $this->getReference($categoryReference);
        if ($category) {
            $subcategory->setCategory($category);
            $manager->persist($subcategory);
        } else {
            throw new \Exception("No se encontró la referencia para la categoría '$categoryReference'");
        }
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}