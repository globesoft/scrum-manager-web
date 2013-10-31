<?php

namespace GlobeSoft\ScrumManagerWebBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AccountRepository extends EntityRepository {

    /**
     * Checks if a username already exists in the system.
     * @param string $username The username to check for.
     * @return bool Whether or not the username exists in the system.
     */
    public function checkIfUsernameExists($username) {
        $criteria = array(
            'username' => $username
        );

        $entity = $this->findOneBy($criteria);

        return ($entity === null) ? false : true;
    }
}