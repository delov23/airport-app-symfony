<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Authentication
 *
 * @ORM\Table(name="authentications")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuthenticationRepository")
 */
class Authentication
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column("id")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="auth_string", type="text")
     */
    private $authString;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="expiry_date", type="datetime")
     */
    private $expiryDate;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="authentications")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * Set authString
     *
     * @param string $authString
     *
     * @return Authentication
     */
    public function setAuthString($authString)
    {
        $this->authString = $authString;

        return $this;
    }

    /**
     * Get authString
     *
     * @return string
     */
    public function getAuthString()
    {
        return $this->authString;
    }

    /**
     * Set expiryDate
     *
     * @param DateTime $expiryDate
     *
     * @return Authentication
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * Get expiryDate
     *
     * @return DateTime
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
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
     * @return Authentication
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}

