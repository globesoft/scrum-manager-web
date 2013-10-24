<?php

namespace GlobeSoft\ScrumManagerWebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use GlobeSoft\ScrumManagerWebBundle\Service\GeneralHelperService;

/**
 * Class Account represents the account of a regular user on the website. A user can login/logout and perform
 * a variety of operations, based on their ACL.
 * @package GlobeSoft\ScrumManagerWebBundle\Entity
 * @ORM\Entity(repositoryClass="GlobeSoft\ScrumManagerWebBundle\Repository\AccountRepository")
 * @ORM\Table(name="account")
 */
class Account {

    /**
     * Class constructor.
     */
    public function __construct() {
        $this->setCreatedAt(new DateTime('now'));
        $this->setUpdatedAt(new DateTime('now'));
        $this->setActive(false);
        $this->setDeleted(false);

        $this->setSeed(GeneralHelperService::generateRandomString(20));
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=60)
     */
    protected $seed;

    /**
     * @ORM\Column(type="string", length=180)
     */
    protected $email;

    /**
     * @ORM\Column(name="full_name", type="string", length=160)
     */
    protected $full_name;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active = true;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $deleted = true;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = hash('sha512', $this->seed . $password);
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set seed
     *
     * @param string $seed
     * @return Account
     */
    public function setSeed($seed)
    {
        $this->seed = $seed;
    
        return $this;
    }

    /**
     * Get seed
     *
     * @return string 
     */
    public function getSeed()
    {
        return $this->seed;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Account
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set full_name
     *
     * @param string $fullName
     * @return Account
     */
    public function setFullName($fullName)
    {
        $this->full_name = $fullName;
    
        return $this;
    }

    /**
     * Get full_name
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Account
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Account
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Account
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Account
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}