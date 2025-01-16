<?php

namespace App\Repository;

use App\Entity\Subcategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subcategory>
 */
class SubcategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subcategory::class);
    }

    /**
     * @return Subcategory[] Returns an array of Subcategory objects for a given category ID
     */
    public function findByCategory($categoryId): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.category = :categoryId') // Asegúrate de que Subcategory tiene una propiedad category
            ->setParameter('categoryId', $categoryId)
            ->orderBy('s.id', 'ASC') // Puedes cambiar el orden según tu preferencia
            ->getQuery()
            ->getResult();
    }
}
