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
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
    

    private function createSubcategory(string $name, string $categoryReference, ObjectManager $manager): void
    {
       echo "Intentando cargar subcategorias: $name para la categoria: $categoryReference\n";

       if (!$this->hasReference($categoryReference)){
        echo "No se encontro la referencia para la categoria '{$categoryReference}'\n";
        return;
       }
       $subcategory = new Subcategory();
       $subcategory->setName($name);
       $category = $this->getReference($categoryReference);
       $subcategory->setCategory($category);
       $manager->persist($subcategory);


       
    }

    
}