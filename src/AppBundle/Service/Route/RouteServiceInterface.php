<?php


namespace AppBundle\Service\Route;


use AppBundle\Entity\Route;

interface RouteServiceInterface
{
    public function create(Route $route): void;

    /**
     * @return Route[]|null
     */
    public function getAll(): ?array;

    public function getById($id): ?Route;
}
