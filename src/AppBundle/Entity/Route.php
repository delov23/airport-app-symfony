<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * Route
 *
 * @ORM\Table(name="routes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RouteRepository")
 * @Vich\Uploadable()
 */
class Route implements \Serializable
{
    /**
     * @var string
     *
     * @ORM\Id()
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
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=6)
     */
    private $duration;

    /**
     * @var int
     *
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $imageName;

    /**
     * @var File|null
     *
     * @UploadableField(mapping="flight_image", fileNameProperty="imageName", dimensions={})
     */
    private $image;


    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->flightNumber;
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
     * @param string $duration
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
     * @return string
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
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     * @return Route
     */
    public function setImageName(string $imageName): Route
    {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImage(): ?File
    {
        return $this->image;
    }

    /**
     * @param File $image
     * @return Route
     */
    public function setImage(File $image = null): Route
    {
        $this->image = $image;
        return $this;
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->toAirport,
            $this->fromAirport,
            $this->flightNumber,
            $this->seats,
            $this->duration,
            $this->company,
            $this->imageName
        ]);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->toAirport,
            $this->fromAirport,
            $this->flightNumber,
            $this->seats,
            $this->duration,
            $this->company,
            $this->imageName
            ) = unserialize($serialized);
    }
}

