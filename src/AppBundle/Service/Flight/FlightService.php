<?php


namespace AppBundle\Service\Flight;


use AppBundle\Entity\Flight;
use AppBundle\Entity\Search;
use AppBundle\Repository\FlightRepository;
use AppBundle\Service\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FlightService extends AbstractService implements FlightServiceInterface
{
    /**
     * @var FlightRepository
     */
    private $flightRepository;


    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em, FlightRepository $flightRepository)
    {
        parent::__construct($encoder, $em);
        $this->flightRepository = $flightRepository;
    }

    public function create(Flight $flight): void
    {
        if (!$flight->getSeatsTaken()) {
            $flight->setSeatsTaken(0);
        }
        $this->save($flight);
    }

    /**
     * @param string $type
     * @return Flight[]|null
     */
    public function getByType(string $type): ?array
    {
        return $this->flightRepository->findByType($type);
    }

    /**
     * @param $id
     * @return Flight[]|null
     */
    public function getByFlightNumber($id): ?array
    {
        return $this->flightRepository->findByFlightNumber($id);
    }

    public function getById(int $id): ?Flight
    {
        /** @var Flight|null $flight */
        $flight = $this->flightRepository->find($id);
        return $flight;
    }

    public function remove(Flight $flight): void
    {
        $this->em->remove($flight);
        $this->em->flush();
    }

    public function edit(Flight $flight): bool
    {
        if (!$flight || $flight->getSeatsTaken() > $flight->getRoute()->getSeats()) {
            return false;
        }
        $this->em->merge($flight);
        $this->em->flush();
        return true;
    }
}