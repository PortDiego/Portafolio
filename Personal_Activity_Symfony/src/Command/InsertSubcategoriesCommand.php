<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Subcategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:insert-subcategories', // Nombre del comando
    description: 'Insertar subcategorías en la base de datos.'
)]
class InsertSubcategoriesCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }
    protected function configure()
    {
        // Descripción y ayuda opcionales
        $this
            ->setDescription('Insertar subcategorías en la base de datos.')
            ->setHelp('Este comando permite insertar subcategorías en la base de datos.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $categoryRepository = $this->entityManager->getRepository(Category::class);

        // Insertar subcategorías para la primera categoría
        $category1 = $categoryRepository->find(1);
        if (!$category1) {
            $output->writeln('Error: No se encontró una categoría con el ID 1.');
            return Command::FAILURE;
        }
        $subcategories1 = ['Via Ferrata', 'Escalada Clasica', 'Boulder', 'Escalada Deportiva', 'Treeking', 'MTB', 'CicloTurismo', 'Senderismo', 'Espeologia'];

        foreach ($subcategories1 as $subcategoryName) {
            $subcategory = new Subcategory();
            $subcategory->setName($subcategoryName);
            $subcategory->setCategory($category1);

            $this->entityManager->persist($subcategory);
        }

        // Insertar subcategorías para la segunda categoría
        $category2 = $categoryRepository->find(2);
        if (!$category2) {
            $output->writeln('Error: No se encontró una categoría con el ID 2.');
            return Command::FAILURE;
        }
        $subcategories2 = ['Submarinismo', 'Barranquismo', 'Rafting', 'HidroSpeed', 'Piraguismo', 'Surf', 'PadelSurf', 'KiteSurf', 'Vela'];

        foreach ($subcategories2 as $subcategoryName) {
            $subcategory = new Subcategory();
            $subcategory->setName($subcategoryName);
            $subcategory->setCategory($category2);

            $this->entityManager->persist($subcategory);
        }

        $this->entityManager->flush();

        $output->writeln('Subcategorías insertadas correctamente.');

        return Command::SUCCESS;
    }
}
