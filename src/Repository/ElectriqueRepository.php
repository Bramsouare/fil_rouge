<?php

namespace App\Repository;

use App\Entity\Electrique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Electrique>
 *
 * @method Electrique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Electrique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Electrique[]    findAll()
 * @method Electrique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Electrique::class);
    }

//    /**
//     * @return Electrique[] Returns an array of Electrique objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Electrique
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
