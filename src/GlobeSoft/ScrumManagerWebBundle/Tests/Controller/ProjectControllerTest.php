<?php
/**
 * Created by JetBrains PhpStorm.
 * User: petre
 * Date: 10/31/13
 * Time: 4:49 PM
 * To change this template use File | Settings | File Templates.
 */

namespace GlobeSoft\ScrumManagerWebBundle\Tests\Controller;


use GlobeSoft\ScrumManagerWebBundle\Service\GeneralHelperService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase {

    public function testUrlIsAccessible() {
        $client = static::createClient();

        // REGISTER
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/account/register');

        $form = $crawler->selectButton('Sign up')->form();

        $fullName = GeneralHelperService::generateRandomString(10) . ' ' . GeneralHelperService::generateRandomString(10);
        $username = GeneralHelperService::generateRandomString(25);
        $password = GeneralHelperService::generateRandomString(25);

        $form['account_register[fullName]'] = $fullName;
        $form['account_register[username]'] = $username;
        $form['account_register[email]'] = GeneralHelperService::generateRandomString(15) . '@dreamlabs.ro';
        $form['account_register[password]'] = $password;

        $crawler = $client->submit($form);

        $this->assertGreaterThan(0, $crawler->filter('html:contains("All done!")')->count());

        // LOGIN
        $crawler = $client->request('GET', '/account/login');

        $form = $crawler->selectButton('Sign in')->form();

        $form['_username'] = $username;
        $form['_password'] = $password;

        $crawler = $client->submit($form);
        $this->assertGreaterThan(0, $crawler->filter('html:contains("' . $fullName . '")')->count());

        $crawler = $client->request('GET', '/project');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}