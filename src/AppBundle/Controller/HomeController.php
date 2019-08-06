<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
}
