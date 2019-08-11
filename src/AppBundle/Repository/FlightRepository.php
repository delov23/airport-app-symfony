<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Flight;
use AppBundle\Entity\Search;
use AppBundle\Service\Route\RouteServiceInterface;
use DateInterval;
use DateTime;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

/**
 * FlightRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FlightRepository extends EntityRepository
{
    private $routeService;

    public function __construct(EntityManagerInterface $em, RouteServiceInterface $routeService)
    {
        $md = new ClassMetadata(Flight::class);
        parent::__construct($em, $md);
        $this->routeService = $routeService;
    }

    /**
     * @param string $type
     * @return Flight[]|null
     * @throws Exception
     */
    public function findByType(string $type)
    {
        $start = new DateTime('-1 day');
        $end = new DateTime('1 day');
        $qb = $this->createQueryBuilder('f')
            ->select('f')
            ->addSelect('r')
            ->join('f.route', 'r');
        if ($type === 'arrivals') {
            $qb->where("r.toAirport = 'Plovdiv Airport'");
        } else if ($type === 'departures') {
            $qb->where("r.fromAirport = 'Plovdiv Airport'");
        } else {
            return null;
        }
        $qb
            ->andWhere('f.date > :start')
            ->andWhere('f.date < :end')
            ->setParameter('start', $start, Type::DATETIME)
            ->orderBy('f.date', 'ASC')
            ->setParameter('end', $end, Type::DATETIME);
        return $qb->getQuery()->getResult();
    }

    public function findByFlightNumber($id): ?array
    {
        return $this
            ->createQueryBuilder('f')
            ->select('f')
            ->addSelect('r')
            ->join('f.route', 'r')
            ->where('r.flightNumber = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
