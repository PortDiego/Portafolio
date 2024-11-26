<?php

namespace App\DataFixtures;

use App\Entity\Subcategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\DependencyInjection\Attribute\When;

#[When("test")]
class SubcategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        echo "cargando subcategorias...\n";
        // Subcategorías para Montaña
        $this->createSubcategory('Senderismo', 'montana', $manager);
        $this->createSubcategory('Escalada Clasica', 'montana', $manager);
        $this->createSubcategory('Boulder', 'montana', $manager);
        $this->createSubcategory('Escalada Deportiva', 'montana', $manager);
        $this->createSubcategory('Via Ferrata', 'montana', $manager);
        $this->createSubcategory('Escalada Clasica', 'montana', $manager);
        $this->createSubcategory('Paracaidismo', 'montana', $manager);
        $this->createSubcategory('Puenting', 'montana', $manager);
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
        $this->createSubcategory('Esquí de travesía', 'nieve', $manager);
        $this->createSubcategory('Freestyle', 'nieve', $manager);
        $this->createSubcategory('Raquetas de nieve', 'nieve', $manager);
        $this->createSubcategory('Escalada en hielo', 'nieve', $manager);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,  // Dependencia de CategoryFixtures para asegurar que las categorías existan
        ];
    }

    private function createSubcategory(string $name, string $categoryReference, ObjectManager $manager): void
    {
        echo "Intentando cargar subcategorías: $name para la categoría: $categoryReference\n";

        if (!$this->hasReference($categoryReference)) {
            echo "No se encontró la referencia para la categoría '{$categoryReference}'\n";
            return; // Si la categoría no existe, no creamos la subcategoría
        }

        // Verificar si la subcategoría ya existe para evitar duplicados
        $category = $this->getReference($categoryReference);
        $existingSubcategory = $manager->getRepository(Subcategory::class)->findOneBy([
            'name' => $name,
            'category' => $category
        ]);

        if ($existingSubcategory) {
            echo "Subcategoría '{$name}' ya existe para la categoría '{$categoryReference}', no se duplicará.\n";
            return; // Si la subcategoría ya existe, no la creamos
        }

        // Si no existe, creamos y persistimos la nueva subcategoría
        $subcategory = new Subcategory();
        $subcategory->setName($name);
        $subcategory->setCategory($category);  // Establecer la categoría asociada
        $manager->persist($subcategory);
    }
}
