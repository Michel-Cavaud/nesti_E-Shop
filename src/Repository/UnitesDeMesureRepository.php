<?php

namespace App\Repository;

use App\Entity\UnitesDeMesure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnitesDeMesure|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnitesDeMesure|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnitesDeMesure[]    findAll()
 * @method UnitesDeMesure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnitesDeMesureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnitesDeMesure::class);
    }

    // /**
    //  * @return UnitesDeMesure[] Returns an array of UnitesDeMesure objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UnitesDeMesure
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
