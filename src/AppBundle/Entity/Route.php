<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RouteRepository")
 */
class Route
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="flight_number", type="string", length=255, unique=true)
     */
    private $flightNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="from_airport", type="string", length=255)
     */
    private $fromAirport;

    /**
     * @var string
     *
     * @ORM\Column(name="to_airport", type="string", length=255)
     */
    private $toAirport;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duration", type="time")
     */
    private $duration;

    /**
     * @var int
     *
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set flightNumber
     *
     * @param string $flightNumber
     *
     * @return Route
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    /**
     * Get flightNumber
     *
     * @return string
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Route
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set fromAirport
     *
     * @param string $fromAirport
     *
     * @return Route
     */
    public function setFromAirport($fromAirport)
    {
        $this->fromAirport = $fromAirport;

        return $this;
    }

    /**
     * Get fromAirport
     *
     * @return string
     */
    public function getFromAirport()
    {
        return $this->fromAirport;
    }

    /**
     * Set toAirport
     *
     * @param string $toAirport
     *
     * @return Route
     */
    public function setToAirport($toAirport)
    {
        $this->toAirport = $toAirport;

        return $this;
    }

    /**
     * Get toAirport
     *
     * @return string
     */
    public function getToAirport()
    {
        return $this->toAirport;
    }

    /**
     * Set duration
     *
     * @param \DateTime $duration
     *
     * @return Route
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \DateTime
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     *
     * @return Route
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return int
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Route
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}

