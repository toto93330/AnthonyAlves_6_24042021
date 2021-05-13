<?php

namespace App\Repository;

use App\Entity\ValidateUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ValidateUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValidateUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValidateUser[]    findAll()
 * @method ValidateUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValidateUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValidateUser::class);
    }

    // /**
    //  * @return ValidateUser[] Returns an array of ValidateUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValidateUser
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
