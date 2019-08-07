<?php


namespace AppBundle\Service\Security;


use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Http\HttpUtils;

class AuthFail extends DefaultAuthenticationFailureHandler
{
    /** @var FlashBagInterface */
    private  $flashBag;


    public function __construct(HttpKernelInterface $httpKernel, HttpUtils $httpUtils,  FlashBagInterface $flashBag, array $options = [], LoggerInterface $logger = null)
    {
        $this->flashBag = $flashBag;
        parent::__construct($httpKernel, $httpUtils, $options, $logger);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $this->flashBag->add('error', 'Wrong credentials.');

        return parent::onAuthenticationFailure($request, $exception);
    }
}