<?php


namespace AppBundle\Service\Route;


use AppBundle\Entity\Route;

interface RouteServiceInterface
{
    public function create(Route $route): bool;

    /**
     * @return Route[]|null
     */
    public function getAll(): ?array;

    public function getById($id): ?Route;

    /**
     * @return Route[]
     */
    public function getAllDepartures(): array;

    /**
     * @return Route[]
     */
    public function getAllArrivals(): array;

    public function edit(Route $route): void;

}
