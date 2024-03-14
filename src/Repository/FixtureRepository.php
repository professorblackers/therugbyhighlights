<?php

namespace App\Repository;

use App\Entity\Fixture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fixture>
 *
 * @method Fixture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fixture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fixture[]    findAll()
 * @method Fixture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FixtureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fixture::class);
    }

    public function getFixturesToday()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.kickOff > CURRENT_DATE()')
            ->andWhere('f.kickOff < CURRENT_DATE()+1')
            ->getQuery()
            ->getResult();
    }

    public function getFixturesYesterday()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.kickOff > CURRENT_DATE()-1')
            ->andWhere('f.kickOff < CURRENT_DATE()')
            ->getQuery()
            ->getResult();
    }

    public function getFixturesTwoDaysAgo()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.kickOff > CURRENT_DATE()-2')
            ->andWhere('f.kickOff < CURRENT_DATE()-1')
            ->getQuery()
            ->getResult();
    }

    public function getUpcomingFixtures()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.kickOff > CURRENT_DATE()')
            ->orderBy('f.kickOff', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getPastFixtures()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.kickOff < CURRENT_DATE()')
            ->orderBy('f.kickOff', 'DESC')
            ->getQuery()
            ->getResult();
    }
}