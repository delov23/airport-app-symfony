<?php


namespace AppBundle\Service\Authentication;


use AppBundle\Entity\Authentication;
use AppBundle\Entity\User;
use AppBundle\Repository\AuthenticationRepository;
use AppBundle\Service\AbstractService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthenticationService extends AbstractService implements AuthenticationServiceInterface
{
    /**
     * @var AuthenticationRepository
     */
    private $authenticationRepository;


    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $em, AuthenticationRepository $authenticationRepository)
    {
        parent::__construct($encoder, $em);
        $this->authenticationRepository = $authenticationRepository;
    }

    public function create(User $user): ?Authentication
    {
        if ($user->hasAuthentication()) {
            return null;
        }
        $auth = new Authentication();
        $auth->setUser($user)->setExpiryDate(new DateTime('10 minute'));
        $auth->setAuthString(bin2hex(random_bytes(200)));
        $this->save($auth);
        return $auth;
    }

    public function checkString(User $user, string $authString): bool
    {
        foreach ($user->getAuthentications() as $auth) {
            if ($auth->getAuthString() === $authString && $auth->getExpiryDate() > new DateTime()) {
                return true;
            }
        }
        return false;
    }
}