<?php

namespace GlobeSoft\ScrumManagerWebBundle\Controller;


use GlobeSoft\ScrumManagerWebBundle\Entity\Account;
use GlobeSoft\ScrumManagerWebBundle\Form\Account\AccountRegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller{

    public function registerAction(Request $request) {
        $account = new Account();

        $form = $this->createForm(new AccountRegisterForm(), $account);

        $form->handleRequest($request);

        if ($form->isValid()) {
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
}