<?php

namespace App\Repository;

use App\Entity\Francais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Francais>
 *
 * @method Francais|null find($id, $lockMode = null, $lockVersion = null)
 * @method Francais|null findOneBy(array $criteria, array $orderBy = null)
 * @method Francais[]    findAll()
 * @method Francais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrancaisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Francais::class);
    }

//    /**
//     * @return Francais[] Returns an array of Francais objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Francais
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
