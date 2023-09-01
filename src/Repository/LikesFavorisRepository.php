<?php

namespace App\Repository;

use App\Entity\LikesFavoris;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LikesFavoris>
 *
 * @method LikesFavoris|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikesFavoris|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikesFavoris[]    findAll()
 * @method LikesFavoris[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikesFavorisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikesFavoris::class);
    }

//    /**
//     * @return LikesFavoris[] Returns an array of LikesFavoris objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LikesFavoris
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
