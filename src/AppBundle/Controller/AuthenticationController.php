<?php

namespace AppBundle\Controller;

use AppBundle\Form\ChangePasswordType;
use AppBundle\Service\Authentication\AuthenticationServiceInterface;
use AppBundle\Service\Email\EmailServiceInterface;
use AppBundle\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auth")
 */
class AuthenticationController extends BaseController
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authenticationService;

    /**
     * @var EmailServiceInterface
     */
    private $emailService;

    /**
     * @var UserServiceInterface
     */
    private $userService;


    /**
     * @param AuthenticationServiceInterface $authenticationService
     * @param EmailServiceInterface $emailService
     */
    public function __construct(AuthenticationServiceInterface $authenticationService, EmailServiceInterface $emailService, UserServiceInterface $userService)
    {
        $this->authenticationService = $authenticationService;
        $this->emailService = $emailService;
        $this->userService = $userService;
    }

    /**
     * @Route("/password/reset", name="password_reset", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function resetPasswordView()
    {
        $auth = $this->authenticationService->create($this->getUser());
        if ($auth) {
            $this->emailService->sendEmail($this->getUser(),
                $this->renderView('auth/reset-password-email.html.twig', ['auth' => $auth]));
        }
        return $this->render('auth/reset-password.html.twig', ['message' => $auth ? 'A reset password email has been sent to ' : 'An email has already been sent to ']);
    }

    /**
     * @Route("/password/new", name="password_reset_action", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function resetPasswordActionView()
    {
        return $this->render('auth/reset-password-form.html.twig', [
            'form' => $this->createForm(ChangePasswordType::class)->createView()
        ]);
    }

    /**
     * @Route("/password/new", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return Response
     */
    public function resetPasswordActionProcess(Request $request)
    {
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);
        $valid = $this->authenticationService->checkString($this->getUser(), $request->get('authString'));
        if ($valid && $form->isValid()) {
            $user = $this->userService->getById($this->getUser()->getId());
            $this->userService->resetPassword($user, $form->get('password')->getData());
            $this->addFlash('success', 'Your password has been reset.');
            return $this->redirectToRoute('user_profile');
        } else {
            return $this->render('auth/reset-password-form.html.twig', [
                'errors' => $this->mapErrors($form->getErrors(true)),
                'form' => $form->createView(),
                'stringError' => $valid ? null : 'Your auth string is not valid anymore. Request new password change.']
            );
        }
    }
}
