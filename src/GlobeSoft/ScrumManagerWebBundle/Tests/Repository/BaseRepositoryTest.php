<?php
/**
 * Created by JetBrains PhpStorm.
 * User: petre
 * Date: 10/31/13
 * Time: 3:55 PM
 * To change this template use File | Settings | File Templates.
 */

namespace GlobeSoft\ScrumManagerWebBundle\Tests\Repository;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseRepositoryTest extends WebTestCase {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}