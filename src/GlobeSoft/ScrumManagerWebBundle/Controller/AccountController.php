<?php

namespace GlobeSoft\ScrumManagerWebBundle\Controller;


use GlobeSoft\ScrumManagerWebBundle\Entity\Account;
use GlobeSoft\ScrumManagerWebBundle\Form\Account\AccountRegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

class AccountController extends Controller{

    public function registerAction(Request $request) {
        $account = new Account();

        $form = $this->createForm(new AccountRegisterForm(), $account);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($account);

            $password = $encoder->encodePassword($account->getPassword(), $account->getSalt());
            $account->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();

            return $this->render('@GSScrumWeb/Account/register_success.html.twig', array(
                'account' => $account
            ));
        }

        return $this->render('GSScrumWebBundle:Account:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            '@GSScrumWeb/Account/login.html.twig',
            array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }
}