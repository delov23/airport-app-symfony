<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseController extends Controller
{
    protected function getFormArray(string $type, object $entity, string $entityName): array
    {
        return [
            'form' => $this->createForm($type, $entity)->createView(),
            $entityName => $entity
        ];
    }

    protected function verifyEntity(string $type, string $entityName, object $emptyEntity, Request $request, string $templateOnFail, callable $logic, string $routeOnSuccess = 'index')
    {
        $entity = $emptyEntity;
        $form = $this->createForm($type, $entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $logic($entity);
            return $this->redirectToRoute($routeOnSuccess);
        } else {
            return $this->render($templateOnFail,
                array_merge($this->getFormArray($type, $entity, $entityName),
                    ['errors' => $this->mapErrors($form->getErrors(true))])
            );
        }
    }

    protected function mapErrors(FormErrorIterator $errors)
    {
        $newArr = [];
        foreach ($errors as $error) {
            $key = $error->getOrigin()->getName();
            if (!key_exists($key, $newArr)) {
                $newArr[$key] = [];
            }
            $newArr[$key][] = $error->getMessage();
        }
        return $newArr;
    }
}