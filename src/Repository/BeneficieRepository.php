<?php

namespace App\Repository;

use App\Entity\Beneficie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Beneficie>
 *
 * @method Beneficie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beneficie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beneficie[]    findAll()
 * @method Beneficie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeneficieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beneficie::class);
    }

//    /**
//     * @return Beneficie[] Returns an array of Beneficie objects
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

//    public function findOneBySomeField($value): ?Beneficie
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
