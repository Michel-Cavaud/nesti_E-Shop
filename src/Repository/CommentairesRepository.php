<?php

namespace App\Repository;

use App\Entity\Commentaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaires[]    findAll()
 * @method Commentaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaires::class);
    }

    // /**
    //  * @return Commentaires[] Returns an array of Commentaires objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commentaires
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function insertCommentaires($commentaire)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $contenu = nl2br(stripslashes(strip_tags($commentaire->getContenuCommentaires())));

        $sql = "INSERT INTO `commentaires` (`id_utilisateurs`, `id_recettes`, `titre_commentaires`, `contenu_commentaires`, 
        `etat_commentaires`) VALUES (:idUser, :idRecette, :titre, :contenu, 'b')";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            'idUser' => $commentaire->getIdUtilisateurs()->getId(), 'idRecette' => $commentaire->getIdRecettes()->getId(),
            'titre' => $commentaire->getTitreCommentaires(), 'contenu' => $contenu
        ));
    }
}
