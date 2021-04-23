<?php

namespace App\Repository;

use App\Entity\Paragraphes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paragraphes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paragraphes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paragraphes[]    findAll()
 * @method Paragraphes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParagraphesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paragraphes::class);
    }

    // /**
    //  * @return Paragraphes[] Returns an array of Paragraphes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Paragraphes
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
