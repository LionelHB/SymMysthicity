<?php

namespace App\Repository;

use App\Entity\Anthology;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Anthology>
 *
 * @method Anthology|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anthology|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anthology[]    findAll()
 * @method Anthology[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnthologyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anthology::class);
    }

//    /**
//     * @return Anthology[] Returns an array of Anthology objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Anthology
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
