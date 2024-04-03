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

    public function getFixtures()
    {
        return $this->createQueryBuilder('f')
            ->select('f.id, f.league, f.homeTeam, f.awayTeam, f.kickOff, f.highlights')
            ->getQuery()
            ->getResult();
    }
}