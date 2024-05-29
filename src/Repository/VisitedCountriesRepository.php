<?php

namespace App\Repository;

use App\Entity\VisitedCountries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VisitedCountries>
 *
 * @method VisitedCountries|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitedCountries|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitedCountries[]    findAll()
 * @method VisitedCountries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitedCountriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitedCountries::class);
    }

//    /**
//     * @return VisitedCountries[] Returns an array of VisitedCountries objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VisitedCountries
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
