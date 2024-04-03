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

    /**
     * Get fixtures
     *
     * @return mixed
     */
    public function getFixtures(): mixed
    {
        return $this->createQueryBuilder('f')
            ->select('f.id, f.league, f.homeTeam, f.awayTeam, f.kickOff, f.highlights')
            ->getQuery()
            ->getResult();
    }

    /**
     * Get upcoming fixtures
     *
     * @return mixed
     */
    public function getUpcomingFixtures(): mixed
    {
        $today = new DateTime();

        return $this->createQueryBuilder('f')
            ->select('f.id, f.league, f.homeTeam, f.awayTeam, f.kickOff, f.highlights')
            ->andWhere('f.kickOff > :today')
            ->setParameter('today', $today)
            ->orderBy('f.kickOff', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Get past fixtures based on the $daysAgo parameter
     *
     * @param $daysAgo
     * @return mixed
     */
    public function getPastFixtures($daysAgo): mixed
    {
        $date = new DateTime();
        $date->modify('-' . $daysAgo . ' days');

        return $this->createQueryBuilder('f')
            ->select('f.id, f.league, f.homeTeam, f.awayTeam, f.kickOff, f.highlights')
            ->andWhere('f.kickOff < :date')
            ->setParameter('date', $date)
            ->orderBy('f.kickOff', 'DESC')
            ->getQuery()
            ->getResult();
    }
}