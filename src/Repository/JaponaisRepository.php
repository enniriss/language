<?php

namespace App\Repository;

use App\Entity\Japonais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Japonais>
 *
 * @method Japonais|null find($id, $lockMode = null, $lockVersion = null)
 * @method Japonais|null findOneBy(array $criteria, array $orderBy = null)
 * @method Japonais[]    findAll()
 * @method Japonais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JaponaisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Japonais::class);
    }

//    /**
//     * @return Japonais[] Returns an array of Japonais objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Japonais
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
