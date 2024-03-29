<?php


namespace AppBundle\Service\Flight;


use AppBundle\Entity\Flight;
use AppBundle\Entity\Search;
use AppBundle\Form\FlightDetailsType;

interface FlightServiceInterface
{
    public function create(Flight $flight): void;

    /**
     * @param string $type
     * @return Flight[]|null
     */
    public function getByType(string $type): ?array;

    public function getByFlightNumber($id): ?array;

    public function getById(int $id): ?Flight;

    public function remove(Flight $flight): void;

    public function edit(Flight $flight): bool;
}