<?php


namespace AppBundle\Service\Email;


use AppBundle\Entity\User;
use AppBundle\Service\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EmailService extends AbstractService implements EmailServiceInterface
{
    private $mailer;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em, Swift_Mailer $mailer)
    {
        parent::__construct($encoder, $em);
        $this->mailer = $mailer;
    }

    public function sendEmail(User $user, string $body, string $bodyType = 'text/html')
    {
        $message = (new Swift_Message('Password Change'))
            ->setFrom('delov23@abv.bg')
            ->setTo($user->getEmail())
            ->setBody($body, $bodyType);

        $this->mailer->send($message);
    }
}