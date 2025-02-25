<?php

namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function search($title) {
        return $this->createQueryBuilder('Activity')
            ->andWhere('Activity.title LIKE :title')
            ->setParameter('title', '%'.$title.'%')
            ->getQuery()
            ->execute();
    }
    public function getByDate(\Datetime $date)
    {
        $from = new \DateTime($date->format("Y-m-d")." 00:00:00");


        $qb = $this->createQueryBuilder("Activity");
        $qb
            ->andWhere('Activity.eventdate >= :from')
            ->orderBy('Activity.eventdate', 'ASC')
            ->setParameter('from', $from )

        ;
        $result = $qb->getQuery()->getResult();

        return $result;
    }
    // /**
    //  * @return Activity[] Returns an array of Activity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
