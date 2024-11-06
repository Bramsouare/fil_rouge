<?php

namespace App\Repository;

use App\Entity\Saxophone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Saxophone>
 *
 * @method Saxophone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Saxophone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Saxophone[]    findAll()
 * @method Saxophone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaxophoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Saxophone::class);
    }

//    /**
//     * @return Saxophone[] Returns an array of Saxophone objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Saxophone
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
