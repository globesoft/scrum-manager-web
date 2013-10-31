<?php
/**
 * Created by JetBrains PhpStorm.
 * User: petre
 * Date: 10/31/13
 * Time: 3:54 PM
 * To change this template use File | Settings | File Templates.
 */

namespace GlobeSoft\ScrumManagerWebBundle\Tests\Repository;


use GlobeSoft\ScrumManagerWebBundle\Entity\Account;
use GlobeSoft\ScrumManagerWebBundle\Repository\AccountRepository;
use GlobeSoft\ScrumManagerWebBundle\Service\GeneralHelperService;
use GlobeSoft\ScrumManagerWebBundle\Tests\Entity\AccountTest;

class AccountRepositoryTest extends BaseRepositoryTest {

    /**
     * @var AccountRepository
     */
    protected $repo;

    public function setUp() {
        parent::setUp();
        $this->repo = $this->em->getRepository('GSScrumWebBundle:Account');
    }

    public function testCheckIfUsernameExists_WhenValid() {
        $seedData = AccountTest::generateSeed();
        $account = AccountTest::createNewEntityFromArray($seedData);

        $this->em->persist($account);
        $this->em->flush();

        $usernameExists = $this->repo->checkIfUsernameExists($seedData['username']);
        $this->assertTrue($usernameExists);
    }

    public function testCheckIfUsernameExists_WhenNotPersisted() {
        $seedData = AccountTest::generateSeed();
        $account = AccountTest::createNewEntityFromArray($seedData);

        $usernameExists = $this->repo->checkIfUsernameExists($seedData['username']);
        $this->assertFalse($usernameExists);
    }
}