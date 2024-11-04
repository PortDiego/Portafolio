<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:reset-subcategory-id',
    description: 'Reiniciar el contador de ID en la tabla de subcategorías.'
)]
class ResetSubcategoryIdCommand extends Command
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
            ->setDescription('Reiniciar el contador de ID en la tabla de subcategorías.')
            ->setHelp('Este comando permite reiniciar el contador de ID en la tabla de subcategorías.');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connection = $this->entityManager->getConnection();
        $connection->executeStatement('ALTER TABLE subcategory AUTO_INCREMENT = 1');

        $output->writeln('Contador de ID en la tabla de subcategorías reiniciado correctamente.');

        return Command::SUCCESS;
    }
}