<?php


namespace AppBundle\Service\Role;


use AppBundle\Entity\Role;

interface RoleServiceInterface
{
    public function findByName(string $name): ?Role;
}