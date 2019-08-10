<?php

namespace AppBundle\Controller;


use AppBundle\Service\Role\RoleServiceInterface;
use AppBundle\Service\Route\RouteServiceInterface;
use AppBundle\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends BaseController
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var RoleServiceInterface
     */
    private $roleService;

    /**
     * @var RouteServiceInterface
     */
    private $routeService;


    /**
     * @param UserServiceInterface $userService
     * @param RoleServiceInterface $roleService
     * @param RouteServiceInterface $routeService
     */
    public function __construct(UserServiceInterface $userService, RoleServiceInterface $roleService, RouteServiceInterface $routeService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->routeService = $routeService;
    }

    /**
     * @Route("/make/{id}", methods={"POST"}, name="make_admin")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param $id
     * @return Response
     */
    public function makeAdminProcess($id)
    {
        $user = $this->userService->getById($id);
        $user->addRole($this->roleService->findByName('ROLE_ADMIN'));
        $this->userService->edit($user);
        return $this->redirectToRoute('admin_panel');
    }

    /**
     * @Route("/panel", methods={"GET"}, name="admin_panel")
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
}
