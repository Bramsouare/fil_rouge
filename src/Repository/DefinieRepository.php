<?php

namespace App\Repository;

use App\Entity\Definie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Definie>
 *
 * @method Definie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Definie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Definie[]    findAll()
 * @method Definie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefinieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Definie::class);
    }

//    /**
//     * @return Definie[] Returns an array of Definie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Definie
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
