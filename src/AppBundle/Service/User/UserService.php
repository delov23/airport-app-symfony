<?php


namespace AppBundle\Service\User;


use AppBundle\Entity\Flight;
use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use AppBundle\Service\AbstractService;
use AppBundle\Service\Role\RoleServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService extends AbstractService implements UserServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleServiceInterface
     */
    private $roleService;


    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em, UserRepository $userRepository, RoleServiceInterface $roleService)
    {
        parent::__construct($encoder, $em);
        $this->userRepository = $userRepository;
        $this->roleService = $roleService;
    }

    public function register(User $user): void
    {
        $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
        $user->addRole($this->roleService->findByName('ROLE_USER'));
        $this->save($user);
    }

    public function getById(int $id): ?User
    {
        /**
         * @var $user User|null
         */
        $user = $this->userRepository->find($id);
        return $user;
    }

    /**
     * @return User[]|null
     */
    public function getAll(): ?array
    {
        return $this->userRepository->findAll();
    }

    public function edit(User $user): void
    {
        $this->update($user);
    }

    public function toggleFlight(User $user, Flight $flight): void
    {
        if (!$user->getFlights()->contains($flight)) {
            $user->addFlight($flight);
        } else {
            $user->getFlights()->removeElement($flight);
        }
        $this->edit($user);
    }

    public function resetPassword(User $user, string $newPassword): void
    {
        $user->setPassword($this->encoder->encodePassword($user, $newPassword));
        $this->save($user);
    }

    public function addRoleAndSave(User $user, Role $role)
    {
        $user->addRole($role);
        $this->update($user);
    }
}