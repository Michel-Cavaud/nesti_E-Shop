<?php

namespace App\Repository;

use App\Entity\DonneUneNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DonneUneNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonneUneNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonneUneNote[]    findAll()
 * @method DonneUneNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonneUneNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonneUneNote::class);
    }

    // /**
    //  * @return DonneUneNote[] Returns an array of DonneUneNote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DonneUneNote
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function insertCommentaires($note)
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = "INSERT INTO `donne_une_note` (`id_utilisateurs`, `id_recettes`, `note_sur5`) 
        VALUES (:idUser, :idRecette, :note)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            'idUser' => $note->getIdUtilisateurs()->getId(), 'idRecette' => $note->getIdRecettes()->getId(),
            'note' => $note->getNoteSur5()
        ));
    }
}
