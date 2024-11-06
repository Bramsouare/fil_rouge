<?php

namespace App\Repository;

use App\Entity\Piano;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Piano>
 *
 * @method Piano|null find($id, $lockMode = null, $lockVersion = null)
 * @method Piano|null findOneBy(array $criteria, array $orderBy = null)
 * @method Piano[]    findAll()
 * @method Piano[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PianoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Piano::class);
    }

//    /**
//     * @return Piano[] Returns an array of Piano objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Piano
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
