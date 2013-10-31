<?php

namespace GlobeSoft\ScrumManagerWebBundle\Tests\Entity;


use \DateTime;
use GlobeSoft\ScrumManagerWebBundle\Entity\Account;
use GlobeSoft\ScrumManagerWebBundle\Service\GeneralHelperService;

class AccountTest extends \PHPUnit_Framework_TestCase {

    protected $seedData;

    public function setUp() {
        parent::setUp();

        $this->seedData = self::generateSeed();
    }

    /**
     * Generate a seed array for the Account entity.
     * @return array Seed array for the Account entity.
     */
    public static function generateSeed() {
        return array(
            'username' => GeneralHelperService::generateRandomString(20),
            'fullname' => ucfirst(GeneralHelperService::generateRandomString(10) . ' ' . GeneralHelperService::generateRandomString(10)),
            'password' => GeneralHelperService::generateRandomString(30),
            'email' => GeneralHelperService::generateRandomString(20) . '@dreamlabs.ro',
            'active' => true,
            'deleted' => false
        );
    }

    /**
     * Create a new entity using array data.
     * @param array $data The array that should be used for generating a new entity.
     * @return Account The entity generated from the array data.
     */
    public static function createNewEntityFromArray($data) {
        $accountEntity = new Account();

        $accountEntity
            ->setUsername($data['username'])
            ->setPassword($data['password'])
            ->setFullName($data['fullname'])
            ->setEmail($data['email'])
            ->setActive($data['active'])
            ->setDeleted($data['deleted']);

        return $accountEntity;
    }

    public function testThatDefaultsAreCorrectlySet() {
        $accountEntity = new Account();

        $this->assertTrue($accountEntity->getActive());
        $this->assertFalse($accountEntity->getDeleted());

        $timeToTest = new DateTime('now');
        $timeToTest->modify('-2 minutes');

        $this->assertGreaterThan($timeToTest, $accountEntity->getCreatedAt());
        $this->assertGreaterThan($timeToTest, $accountEntity->getUpdatedAt());

        $this->assertEquals(20, strlen($accountEntity->getSalt()));

        //assert NULL values
        $this->assertNull($accountEntity->getId());
        $this->assertNull($accountEntity->getUsername());
        $this->assertNull($accountEntity->getFullName());
        $this->assertNull($accountEntity->getEmail());
    }

    public function testAllGettersAndSettersWorkCorrectly() {
        $accountEntity = self::createNewEntityFromArray($this->seedData);

        $this->assertEquals($this->seedData['username'], $accountEntity->getUsername());
        $this->assertEquals($this->seedData['email'], $accountEntity->getEmail());
        $this->assertEquals($this->seedData['fullname'], $accountEntity->getFullName());
        $this->assertEquals($this->seedData['active'], $accountEntity->getActive());
        $this->assertEquals($this->seedData['deleted'], $accountEntity->getDeleted());
        $this->assertNotNull($accountEntity->getPassword());
    }

    public function testThatEntityHasCorrectRole() {
        $accountEntity = self::createNewEntityFromArray($this->seedData);
        $this->assertEquals(array('ROLE_USER'), $accountEntity->getRoles());
        $accountEntity->eraseCredentials();
    }
}