<?php


namespace AppBundle\Service\Route;

use AppBundle\Entity\Route;
use AppBundle\Repository\FlightRepository;
use AppBundle\Repository\RouteRepository;
use AppBundle\Service\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RouteService extends AbstractService implements RouteServiceInterface
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em, RouteRepository $routeRepository)
    {
        parent::__construct($encoder, $em);
        $this->routeRepository = $routeRepository;
    }

    public function create(Route $route): void
    {
        $this->save($route);
    }

    /**
     * @return Route[]|null
     */
    public function getAll(): ?array
    {
        return $this->routeRepository->findAll();
    }

    public function getById($id): ?Route
    {
        /** @var $route Route */
        $route = $this->routeRepository->find($id);
        return $route;
    }

    public function getAllDepartures(): array
    {
        return $this->routeRepository->findBy(['fromAirport' => self::PLOVDIV_AIRPORT]);
    }

    public function getAllArrivals(): array
    {
        return $this->routeRepository->findBy(['toAirport' => self::PLOVDIV_AIRPORT]);
    }
}