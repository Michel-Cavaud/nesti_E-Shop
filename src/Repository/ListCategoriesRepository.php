<?php

namespace App\Repository;

use App\Entity\ListCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListCategories[]    findAll()
 * @method ListCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListCategories::class);
    }

    // /**
    //  * @return ListCategories[] Returns an array of ListCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListCategories
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
