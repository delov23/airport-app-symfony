<?php


namespace AppBundle\Service\Authentication;


use AppBundle\Entity\Authentication;
use AppBundle\Entity\User;

interface AuthenticationServiceInterface
{
    public function create(User $user): ?Authentication;

    public function checkString(User $user, string $authString): bool;
}