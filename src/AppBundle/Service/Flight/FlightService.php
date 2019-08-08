<?php


namespace AppBundle\Service\Flight;


use AppBundle\Entity\Flight;
use AppBundle\Service\AbstractService;

class FlightService extends AbstractService implements FlightServiceInterface
{
    public function create(Flight $flight): void
    {
        if (!$flight->getSeatsTaken()) {
            $flight->setSeatsTaken(0);
        }
        $this->save($flight);
    }
}