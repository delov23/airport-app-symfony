<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flight
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FlightRepository")
 */
class Flight
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
     * @ORM\Column(name="route", type="string", length=255)
     */
    private $route;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="terminal", type="string", length=255)
     */
    private $terminal;

    /**
     * @var string
     *
     * @ORM\Column(name="gate", type="string", length=255)
     */
    private $gate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="check_in", type="datetime")
     */
    private $checkIn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bags_check_in", type="datetime")
     */
    private $bagsCheckIn;

    /**
     * @var int
     *
     * @ORM\Column(name="seats_taken", type="integer")
     */
    private $seatsTaken;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="progress_time", type="time")
     */
    private $progressTime;


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
     * Set route
     *
     * @param string $route
     *
     * @return Flight
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Flight
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set terminal
     *
     * @param string $terminal
     *
     * @return Flight
     */
    public function setTerminal($terminal)
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * Get terminal
     *
     * @return string
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * Set gate
     *
     * @param string $gate
     *
     * @return Flight
     */
    public function setGate($gate)
    {
        $this->gate = $gate;

        return $this;
    }

    /**
     * Get gate
     *
     * @return string
     */
    public function getGate()
    {
        return $this->gate;
    }

    /**
     * Set checkIn
     *
     * @param \DateTime $checkIn
     *
     * @return Flight
     */
    public function setCheckIn($checkIn)
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    /**
     * Get checkIn
     *
     * @return \DateTime
     */
    public function getCheckIn()
    {
        return $this->checkIn;
    }

    /**
     * Set bagsCheckIn
     *
     * @param \DateTime $bagsCheckIn
     *
     * @return Flight
     */
    public function setBagsCheckIn($bagsCheckIn)
    {
        $this->bagsCheckIn = $bagsCheckIn;

        return $this;
    }

    /**
     * Get bagsCheckIn
     *
     * @return \DateTime
     */
    public function getBagsCheckIn()
    {
        return $this->bagsCheckIn;
    }

    /**
     * Set seatsTaken
     *
     * @param integer $seatsTaken
     *
     * @return Flight
     */
    public function setSeatsTaken($seatsTaken)
    {
        $this->seatsTaken = $seatsTaken;

        return $this;
    }

    /**
     * Get seatsTaken
     *
     * @return int
     */
    public function getSeatsTaken()
    {
        return $this->seatsTaken;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Flight
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return \DateTime
     */
    public function getProgressTime()
    {
        return $this->progressTime;
    }

    /**
     * @param \DateTime $progressTime
     * @return Flight
     */
    public function setProgressTime($progressTime)
    {
        $this->progressTime = $progressTime;
        return $this;
    }
}

