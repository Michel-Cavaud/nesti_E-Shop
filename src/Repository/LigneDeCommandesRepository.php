<?php

namespace App\Repository;

use App\Entity\LigneDeCommandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LigneDeCommandes|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneDeCommandes|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneDeCommandes[]    findAll()
 * @method LigneDeCommandes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneDeCommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneDeCommandes::class);
    }

    // /**
    //  * @return LigneDeCommandes[] Returns an array of LigneDeCommandes objects
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
    public function findOneBySomeField($value): ?LigneDeCommandes
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
