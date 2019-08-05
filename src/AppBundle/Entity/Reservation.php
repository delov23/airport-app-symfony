<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @var bool
     *
     * @ORM\Column(name="verified", type="boolean")
     */
    private $verified;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="decimal", precision=10, scale=2)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="seat", type="string", length=20)
     */
    private $seat;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Flight
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Flight")
     * @ORM\JoinColumn(name="flight_id", referencedColumnName="id")
     */
    private $flight;

    /**
     * @var Package
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Progress")
     * @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     */
    private $package;


    public function __construct()
    {
    }

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
     * Set verified
     *
     * @param boolean $verified
     *
     * @return Reservation
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return bool
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return Reservation
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getSeat(): string
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     * @return Reservation
     */
    public function setSeat(string $seat): Reservation
    {
        $this->seat = $seat;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Reservation
     */
    public function setUser(User $user): Reservation
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Flight
     */
    public function getFlight(): Flight
    {
        return $this->flight;
    }

    /**
     * @param Flight $flight
     * @return Reservation
     */
    public function setFlight(Flight $flight): Reservation
    {
        $this->flight = $flight;
        return $this;
    }

    /**
     * @return Package
     */
    public function getPackage(): Package
    {
        return $this->package;
    }

    /**
     * @param Package $package
     * @return Reservation
     */
    public function setPackage(Package $package): Reservation
    {
        $this->package = $package;
        return $this;
    }
}

