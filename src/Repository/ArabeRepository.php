<?php

namespace App\Repository;

use App\Entity\Arabe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Arabe>
 *
 * @method Arabe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arabe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arabe[]    findAll()
 * @method Arabe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArabeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arabe::class);
    }

//    /**
//     * @return Arabe[] Returns an array of Arabe objects
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

//    public function findOneBySomeField($value): ?Arabe
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
