<?php


namespace AppBundle\Service\Email;


use AppBundle\Entity\User;

interface EmailServiceInterface
{
    public function sendEmail(User $user, string $body, string $bodyType = 'text/html');
}