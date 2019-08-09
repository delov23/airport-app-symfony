<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Route as RouteEntity;
use AppBundle\Form\RouteType;
use AppBundle\Service\Route\RouteServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/route")
 */
class RouteController extends BaseController
{
    /**
     * @var RouteServiceInterface
     */
    private $routeService;


    public function __construct(RouteServiceInterface $routeService)
    {
        $this->routeService = $routeService;
    }

    /**
     * @Route("/create", name="route_create", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @return Response
     */
    public function createView()
    {
        return $this->render('route/create.html.twig', $this->getFormArray(RouteType::class, new RouteEntity(), 'route'));
    }

    /**
     * @Route("/create", methods={"POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @return Response
     */
    public function createProcess(Request $request)
    {
        return $this->verifyEntity(RouteType::class, 'route', new RouteEntity(), $request, 'route/create.html.twig',
            function ($route) {
                $this->routeService->create($route);
            }
        );
    }

    /**
     * @Route("/all", name="all_routes", methods={"GET"})
     *
     * @return Response
     */
    public function allView()
    {
        return $this->render('route/all.html.twig', ['routes' => $this->routeService->getAll()]);
    }

    /**
     * @Route("/{id}", name="route_details", methods={"GET"})
     *
     * @param $id
     * @return Response
     */
    public function detailsView($id)
    {
        return $this->render('route/details.html.twig', ['route' => $this->routeService->getById($id)]);
    }

    /**
     * @Route("/edit/{id}", name="route_edit", methods={"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param $id
     * @return Response
     */
    public function editView($id)
    {
        $route = $this->routeService->getById($id);
        return $this->render('route/edit.html.twig', [
            'form' => $this->createForm(RouteType::class, $route)->remove('image')->remove('fromAirport')->remove('toAirport')->remove('flightNumber')->createView(),
            'route' => $route
        ]);
    }

    /**
     * @Route("/edit/{id}", methods={"POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function editProcess(Request $request, string $id)
    {
        $route = $this->routeService->getById($id);
        $form = $this->createForm(RouteType::class, $route);
        $form->remove('fromAirport')->remove('toAirport')->remove('image')->remove('flightNumber');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->routeService->edit($route);
            return $this->redirectToRoute('route_details', ['id' => $id]);
        } else {
            return $this->render('route/edit.html.twig', ['errors' => $this->mapErrors($form->getErrors(true)), 'form' => $form->createView(), 'route' => $route]);
        }
    }
}
