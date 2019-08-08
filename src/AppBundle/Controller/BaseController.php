<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends Controller
{
    protected function getFormArray(string $type, object $entity, string $entityName): array
    {
        return [
            'form' => $this->createForm($type, $entity)->createView(),
            $entityName => $entity
        ];
    }

    /**
     * @param string $type The Form Type. (UserType::class)
     * @param string $entityName The Entity Name for the Template. ('user')
     * @param object $startEntity The Entity itself. (new User())
     * @param Request $request The Controller request. ($request)
     * @param string $templateOnFail The Template in the Get method. ('user/create.html.twig')
     * @param callable $logic The call of the service to manage the entity. ($e) -> $this->service->save($e);
     * @param string $routeOnSuccess Optional. Where to redirect after success (default: 'index')
     * @param array $templateOnFailProps Optional. Any other props for the template in the Get Method.
     * @return Response
     */
    protected function verifyEntity(string $type, string $entityName, object $startEntity, Request $request, string $templateOnFail, callable $logic, string $routeOnSuccess = 'index', array $templateOnFailProps = [])
    {
        $entity = $startEntity;
        $form = $this->createForm($type, $entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $logic($entity);
            return $this->redirectToRoute($routeOnSuccess);
        } else {
            $finalArray = array_merge($this->getFormArray($type, $entity, $entityName), ['errors' => $this->mapErrors($form->getErrors(true))], $templateOnFailProps);
            return $this->render($templateOnFail, $finalArray);
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