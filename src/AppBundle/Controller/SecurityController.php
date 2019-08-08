<?php

namespace AppBundle\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends BaseController
{
    /**
     * @Route("/login", name="security_login")
     *
     * @return Response
     */
    function login()
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }
        return $this->render('user/login.html.twig');
    }

    /**
     * @Route("/logout", name="security_logout")
     *
     * @throws Exception
     */
    function logout()
    {
        throw new Exception('You cannot access this page.');
    }
}
