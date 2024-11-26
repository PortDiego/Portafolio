<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:delete-subcategories',
    description: 'Eliminar todas las subcategorías.'
)]
class DeleteSubcategoriesCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Eliminar todas las subcategorías.')
            ->setHelp('Este comando permite eliminar todas las subcategorías.');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connection = $this->entityManager->getConnection();
        $connection->executeStatement('DELETE FROM subcategory');

        $output->writeln('Subcategorías eliminadas correctamente.');

        return Command::SUCCESS;
    }
}