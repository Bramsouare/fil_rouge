<?php

namespace App\Repository;

use App\Entity\Acoustique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Acoustique>
 *
 * @method Acoustique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acoustique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acoustique[]    findAll()
 * @method Acoustique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcoustiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acoustique::class);
    }

//    /**
//     * @return Acoustique[] Returns an array of Acoustique objects
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

//    public function findOneBySomeField($value): ?Acoustique
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
