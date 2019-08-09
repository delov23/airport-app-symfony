<?php


namespace AppBundle\Service\User;


use AppBundle\Entity\User;

interface UserServiceInterface
{
    public function register(User $user): void;

    public function getById(int $id): ?User;

    public function getAll(): ?array;

    public function edit(User $user): void;
}