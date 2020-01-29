<?php

namespace App\Repository;

use App\Entity\ToEmails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ToEmails|null find($id, $lockMode = null, $lockVersion = null)
 * @method ToEmails|null findOneBy(array $criteria, array $orderBy = null)
 * @method ToEmails[]    findAll()
 * @method ToEmails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToEmailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ToEmails::class);
    }

    // /**
    //  * @return ToEmails[] Returns an array of ToEmails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ToEmails
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
