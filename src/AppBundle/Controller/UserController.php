<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Service\Role\RoleServiceInterface;
use AppBundle\Service\Route\RouteServiceInterface;
use AppBundle\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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

    private $routeService;

    private $roleService;


    public function __construct(UserServiceInterface $userService, RouteServiceInterface $routeService, RoleServiceInterface $roleService)
    {
        $this->userService = $userService;
        $this->routeService = $routeService;
        $this->roleService = $roleService;
    }

    /**
     * @Route("/register", name="user_register", methods={"GET"})
     *
     * @return Response
     */
    public function registerView()
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }
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
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }
        return $this->verifyEntity(UserType::class, 'user', new User(), $request, 'user/register.html.twig',
            function ($user) {
                $this->userService->register($user);
            }, 'security_login'
        );
    }

    /**
     * @Route("/profile", methods={"GET"}, name="user_profile")
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_USER')")
     *
     * @return Response
     */
    public function profileView()
    {
        return $this->render('user/profile.html.twig', ['user' => $this->getUser()]);
    }

    /**
     * @Route("/admin", methods={"GET"}, name="admin_panel")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @return Response
     */
    public function adminPanelView()
    {
        return $this->render('user/admin.html.twig', [
            'routes' => $this->routeService->getAll(),
            'users' => $this->userService->getAll()
        ]);
    }

    /**
     * @Route("/edit", name="user_edit", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function editView()
    {
        $user = $this->getUser();
        return $this->render('user/edit.html.twig', [
            'form' => $this->createForm(UserType::class, $user)->remove('image')->remove('email')->remove('password')->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/edit", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     *
     * @param Request $request
     * @return Response
     */
    public function editProcess(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->remove('email')->remove('password')->remove('image');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->userService->edit($user);
            return $this->redirectToRoute('user_profile');
        } else {
            return $this->render('user/edit.html.twig', ['errors' => $this->mapErrors($form->getErrors(true)), 'form' => $form->createView(), 'user' => $user]);
        }
    }

    /**
     * @Route("/admin/make/{id}", methods={"POST"}, name="make_admin")
     * @Security("has_role('ROLE_ADMIN')")
     *
     *
     * @param Request $request
     * @return Response
     */
    public function makeAdminProcess(Request $request, $id)
    {
        $user = $this->userService->getById($id);
        $user->addRole($this->roleService->findByName('ROLE_ADMIN'));
        $this->userService->edit($user);
        return $this->redirectToRoute('admin_panel');
    }


}
