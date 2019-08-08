<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Flight;
use AppBundle\Service\Route\RouteServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

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
     */
    public function findByType(string $type)
    {
        if ($type === 'arrivals') {
            return $this->createQueryBuilder('f')
                ->select('f')
                ->addSelect('r')
                ->join('f.route', 'r')
                ->where("r.toAirport = 'PDV'")
                ->getQuery()
                ->getResult();
        } else if ($type === 'departures') {
            // TODO ADD DATE
            return $this->createQueryBuilder('f')
                ->select('f')
                ->addSelect('r')
                ->join('f.route', 'r')
                ->where("r.fromAirport = 'PDV'")
                ->getQuery()
                ->getResult();
        } else {
            return null;
        }
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
