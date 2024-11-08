<?php

namespace App\Repository;

use App\Entity\Batterie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Batterie>
 *
 * @method Batterie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Batterie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Batterie[]    findAll()
 * @method Batterie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BatterieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Batterie::class);
    }

//    /**
//     * @return Batterie[] Returns an array of Batterie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Batterie
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
