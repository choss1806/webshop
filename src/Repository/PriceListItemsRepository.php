<?php

namespace App\Repository;

use App\Entity\PriceListItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PriceListItems>
 *
 * @method PriceListItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceListItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceListItems[]    findAll()
 * @method PriceListItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceListItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceListItems::class);
    }

//    /**
//     * @return PriceListItems[] Returns an array of PriceListItems objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PriceListItems
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
