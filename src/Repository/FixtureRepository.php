<?php

namespace App\Repository;

use App\Entity\Fixture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;

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

    private function getFixturesByDateRange(DateTime $startOfDay, DateTime $endOfDay)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.kickOff BETWEEN :startOfDay AND :endOfDay')
            ->setParameter('startOfDay', $startOfDay)
            ->setParameter('endOfDay', $endOfDay)
            ->getQuery()
            ->getResult();
    }

    public function getFixturesToday()
    {
        $today = new DateTime();

        $startOfDay = clone $today;
        $startOfDay->setTime(0, 0, 0);

        $endOfDay = clone $today;
        $endOfDay->setTime(23, 59, 59);

        return $this->getFixturesByDateRange($startOfDay, $endOfDay);
    }

    public function getFixturesByDaysAgo($daysAgo)
    {
        $date = new DateTime();
        $date->modify('-' . $daysAgo . ' days');

        $startOfDay = clone $date;
        $startOfDay->setTime(0, 0, 0);

        $endOfDay = clone $date;
        $endOfDay->setTime(23, 59, 59);

        return $this->getFixturesByDateRange($startOfDay, $endOfDay);
    }

    public function getUpcomingFixtures()
    {
        $today = new DateTime();

        return $this->createQueryBuilder('f')
            ->andWhere('f.kickOff > :today')
            ->setParameter('today', $today)
            ->orderBy('f.kickOff', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getPastFixtures($daysAgo)
    {
        $date = new DateTime();
        $date->modify('-' . $daysAgo . ' days');

        return $this->createQueryBuilder('f')
            ->andWhere('f.kickOff < :date')
            ->setParameter('date', $date)
            ->orderBy('f.kickOff', 'DESC')
            ->getQuery()
            ->getResult();
    }
}