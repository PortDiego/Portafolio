<?php

namespace App\Controller;

use App\Entity\FinishedActivity;
use App\Entity\User;
use App\Entity\Photo;
use App\Form\FinishedActivityType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Obtener el número de actividades finalizadas
        $actividadesFinalizadasCount = $entityManager->getRepository(FinishedActivity::class)
            ->count([]);
        
        // Obtener el número de usuarios registrados
        $usuariosRegistradosCount = $entityManager->getRepository(User::class)
            ->count([]);

        // Obtener el número de fotos subidas
        $fotosSubidasCount = $entityManager->getRepository(Photo::class) // Cambia 'Photo' al nombre de tu entidad para fotos
        ->count([]);

        // Obtener el número de actividades finalizadas por mes
        $actividadesPorMes = $this->getActivitiesByMonth($entityManager);
        
        return $this->render('home/index.html.twig', [
            'actividades_finalizadas_count' => $actividadesFinalizadasCount,
            'usuarios_registrados_count' => $usuariosRegistradosCount,
            'actividades_por_mes' => $actividadesPorMes,
            'fotos_subidas_count' => $fotosSubidasCount,
        ]);
    } 
    #[Route('/home/add-activity', name: 'add_activity')]
    public function addActivity(Request $request, EntityManagerInterface $entityManager): Response
    {
       /*  return $this->redirectToRoute('app_activity_new'); */
    }

    private function getActivitiesByMonth(EntityManagerInterface $entityManager): array
    {
        // Construir la consulta con QueryBuilder
        $query = $entityManager->createQueryBuilder()
            ->select('fa.date AS date') // Alias explícito para la columna
            ->from(FinishedActivity::class, 'fa')
            ->getQuery();

        // Ejecutar la consulta y obtener resultados
        $result = $query->getResult();

        // Inicializar un arreglo para contar las actividades por mes
        $activitiesByMonth = array_fill(0, 12, 0);

        // Iterar sobre los resultados
        foreach ($result as $row) {
            // Verificar si 'date' existe y es un objeto DateTime
            if (isset($row['date']) && $row['date'] instanceof \DateTimeInterface) {
                $month = (int) $row['date']->format('m'); // Extraer el mes (1-12)
                $activitiesByMonth[$month - 1]++; // Incrementar el contador para ese mes
            } else {
                // Manejo de casos donde 'date' no es válido
                dump($row); // Ayuda para depurar en caso de valores inesperados
            }
        }

        return $activitiesByMonth;
    }

}