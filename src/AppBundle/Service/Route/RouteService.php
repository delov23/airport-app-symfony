<?php


namespace AppBundle\Service\Route;

use AppBundle\Entity\Route;
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
}