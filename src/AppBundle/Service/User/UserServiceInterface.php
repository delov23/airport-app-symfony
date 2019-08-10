<?php


namespace AppBundle\Service\User;


use AppBundle\Entity\Flight;
use AppBundle\Entity\Role;
use AppBundle\Entity\User;

interface UserServiceInterface
{
    public function register(User $user): void;

    public function getById(int $id): ?User;

    public function getAll(): ?array;

    public function edit(User $user): void;

    public function toggleFlight(User $user, Flight $flight): void;

    public function resetPassword(User $user, string $newPassword);

    public function addRoleAndSave(User $user, Role $role);
}