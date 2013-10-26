<?php

namespace GlobeSoft\ScrumManagerWebBundle\Form\Account;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AccountRegisterForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullName', 'text', array(
                'attr' => array(
                    'class' => 'span4'
                )
            ))
            ->add('username', 'text', array(
                'attr' => array(
                    'class' => 'span4'
                )
            ))
            ->add('password', 'password', array(
                'attr' => array(
                    'class' => 'span4'
                )
            ))
            ->add('email', 'text', array(
                'attr' => array(
                    'class' => 'span4'
                )
            ));
    }
    public function getName()
    {
        return 'account_register';
    }
}