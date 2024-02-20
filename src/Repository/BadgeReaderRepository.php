<?php

namespace App\Repository;

use App\Entity\BadgeReader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BadgeReader>
 *
 * @method BadgeReader|null find($id, $lockMode = null, $lockVersion = null)
 * @method BadgeReader|null findOneBy(array $criteria, array $orderBy = null)
 * @method BadgeReader[]    findAll()
 * @method BadgeReader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BadgeReaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BadgeReader::class);
    }

//    /**
//     * @return BadgeReader[] Returns an array of BadgeReader objects
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

//    public function findOneBySomeField($value): ?BadgeReader
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
