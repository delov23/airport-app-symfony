<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 * @Vich\Uploadable()
 */
class User implements UserInterface, Serializable
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $imageName;

    /**
     * @var File|null
     *
     * @UploadableField(mapping="user_image", fileNameProperty="imageName", dimensions={})
     */
    private $image;

    /**
     * @var Role[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="users_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")})
     */
    private $roles;

    /**
     * @var Flight[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Flight", inversedBy="users")
     * @ORM\JoinTable(name="users_flights",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="flight_id", referencedColumnName="id")})
     */
    private $flights;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Authentication", mappedBy="user")
     */
    private $authentications;


    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->flights = new ArrayCollection();
        $this->authentications = new ArrayCollection();
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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return User
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string[] The user roles
     */
    public function getRoles()
    {
        $returnArray = [];
        foreach ($this->roles as $role) {
            $returnArray[] = $role->getName();
        }
        return $returnArray;
    }

    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string The username (email in this case)
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     * @return User
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @param Role $role
     * @return User
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;
        return $this;
    }

    public function hasRole(string $role)
    {
        return in_array($role, $this->getRoles());
    }

    /**
     * @return File
     */
    public function getImage(): ?File
    {
        return $this->image;
    }

    /**
     * @param File $image
     * @return User
     */
    public function setImage(File $image): User
    {
        $this->image = $image;
        return $this;
    }

    public function serialize()
    {
        $this->image = base64_encode($this->image);
        return serialize([
            $this->id,
            $this->email,
            $this->password,
            $this->title,
            $this->fullName,
            $this->roles,
            $this->imageName,
            $this->flights,
            $this->authentications
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->title,
            $this->fullName,
            $this->roles,
            $this->imageName,
            $this->flights,
            $this->authentications
            ) = unserialize($serialized);
    }

    /**
     * @return Flight[]|ArrayCollection
     */
    public function getFlights()
    {
        return $this->flights;
    }

    /**
     * @param Flight[]|ArrayCollection $flights
     * @return User
     */
    public function setFlights($flights): User
    {
        $this->flights = $flights;
        return $this;
    }

    public function addFlight(Flight $flight)
    {
        $this->flights[] = $flight;
    }

    /**
     * @return Collection
     */
    public function getAuthentications(): Collection
    {
        return $this->authentications;
    }

    /**
     * @param ArrayCollection|Collection $authentications
     * @return User
     */
    public function setAuthentications(ArrayCollection $authentications): User
    {
        $this->authentications = $authentications;
        return $this;
    }

    /**
     * @param Authentication $authentication
     * @return User
     */
    public function addAuthentication(Authentication $authentication): self
    {
        $this->authentications[] = $authentication;
        return $this;
    }

    public function hasAuthentication(): bool
    {
        $validAuth = $this->authentications->filter(function (Authentication $authentication) {
            return $authentication->getExpiryDate() > new DateTime();
        });

        return $validAuth->count() > 0;
    }
}

