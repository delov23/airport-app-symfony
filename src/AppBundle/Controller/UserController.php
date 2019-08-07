<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Service\User\UserServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends BaseController
{
    /**
     * @var UserServiceInterface
     */
    private $userService;


    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/register", name="user_register", methods={"GET"})
     *
     * @return Response
     */
    public function registerView()
    {
        return $this->render('user/register.html.twig', $this->getFormArray(UserType::class, new User(), 'user'));
    }

    /**
     * @Route("/register", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function registerProcess(Request $request)
    {
        return $this->verifyEntity(UserType::class, 'user', new User(), $request, 'user/register.html.twig',
            function ($user) {
                $this->userService->register($user);
            }, 'security_login'
        );
    }

    /**
     * @Route("/profile", methods={"GET"}, name="user_profile")
     *
     * @param Request $request
     * @return Response
     */
    public function profileView(Request $request)
    {
        return $this->render('user/profile.html.twig', ['user' => $this->getUser()]);
    }
}
