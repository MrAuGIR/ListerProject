<?php

namespace App\Repository;

use App\Entity\Liste;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Liste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Liste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Liste[]    findAll()
 * @method Liste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Liste::class);
    }

    public function findLastChrono(User $user){
        return $this->createQueryBuilder('i')
            ->select("i.chrono")
            ->where("i.user = :user")
            ->setParameter("user", $user)
            ->orderBy('i.chrono',"DESC")
            ->setMaxResults(1)
            ->getQuery()->getSingleScalarResult();
    }

    public function findNextChrono(User $user)
    {
        return $this->createQueryBuilder('i')
            ->select("i.chrono")
            ->where("i.user = :user")
            ->setParameter("user", $user)
            ->orderBy('i.chrono', "DESC")
            ->setMaxResults(1)
            ->getQuery()->getSingleScalarResult() + 1;
    }

    // /**
    //  * @return Liste[] Returns an array of Liste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Liste
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
