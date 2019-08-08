<?php


namespace AppBundle\Service\Flight;


use AppBundle\Entity\Flight;

interface FlightServiceInterface
{
    public function create(Flight $flight): void;
}