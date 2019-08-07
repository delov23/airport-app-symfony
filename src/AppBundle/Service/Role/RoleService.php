<?php


namespace AppBundle\Service\Role;


use AppBundle\Entity\Role;
use AppBundle\Repository\RoleRepository;
use AppBundle\Service\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RoleService extends AbstractService implements RoleServiceInterface
{
    private $roleRepository;


    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em, RoleRepository $roleRepository)
    {
        parent::__construct($encoder, $em);
        $this->roleRepository = $roleRepository;
    }

    public function findByName(string $name): ?Role
    {
        /**
         * @var $role Role|null
         */
        $role = $this->roleRepository->findOneBy(['name' => $name]);
        return $role;
    }
}