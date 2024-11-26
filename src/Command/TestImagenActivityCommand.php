<?php

namespace App\Command;

use App\Entity\Activity;
use App\Entity\ImagenActivity;
use App\Entity\Subcategory; // Asegúrate de importar la clase
use App\Entity\User; // Asegúrate de importar la clase
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'app:test-imagenactivity')]
class TestImagenActivityCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Obtener un usuario existente
        $user = $this->entityManager->getRepository(User::class)->find(1); // Cambia el ID según corresponda
        if (!$user) {
            $output->writeln("No se encontró un usuario válido.");
            return Command::FAILURE;
        }

        // Obtener una subcategoría existente
        $subcategory = $this->entityManager->getRepository(Subcategory::class)->find(1); // Cambia el ID según corresponda
        if (!$subcategory) {
            $output->writeln("No se encontró una subcategoría válida.");
            return Command::FAILURE;
        }

        // Crear una nueva actividad
        $activity = new Activity();
        $activity->setFecha(new \DateTime());
        $activity->setUser($user); // Asigna el usuario
        $activity->setSubcategory($subcategory); // Asigna la subcategoría

        // Crear una nueva ImagenActivity
        $imagenActivity = new ImagenActivity();
        $imagenActivity->setUrl("test-image.jpg"); // Asegúrate de que esta línea asigna un valor válido
        $imagenActivity->setFecha((new \DateTime())->format('Y-m-d'));
        $imagenActivity->setActivity($activity); // Asegúrate de que la actividad no sea null

        // Persistir la actividad y la imagen
        $this->entityManager->persist($activity);
        $this->entityManager->persist($imagenActivity);

        try {
            $this->entityManager->flush();
            $output->writeln("¡Persistencia exitosa de ImagenActivity!");
        } catch (\Exception $e) {
            $output->writeln("Error: " . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}