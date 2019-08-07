<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{
    protected function getFormArray(string $type, object $entity, string $entityName): array
    {
        return [
            'form' => $this->createForm($type, $entity)->createView(),
            $entityName => $entity
        ];
    }
}