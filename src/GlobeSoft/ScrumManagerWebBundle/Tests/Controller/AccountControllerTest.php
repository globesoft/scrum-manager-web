<?php

namespace GlobeSoft\ScrumManagerWebBundle\Tests\Controller;


use GlobeSoft\ScrumManagerWebBundle\Service\GeneralHelperService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountControllerTest extends WebTestCase {

    public function testRegistrationFormIsAccessible() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $link = $crawler->selectLink('Sign up')->link();
        $client->click($link);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testRegistration_Valid() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/account/register');

        $form = $crawler->selectButton('Sign up')->form();

        $form['account_register[fullName]'] = GeneralHelperService::generateRandomString(10) . ' ' . GeneralHelperService::generateRandomString(10);
        $form['account_register[username]'] = GeneralHelperService::generateRandomString(25);
        $form['account_register[email]'] = GeneralHelperService::generateRandomString(15) . '@dreamlabs.ro';
        $form['account_register[password]'] = GeneralHelperService::generateRandomString(25);

        $crawler = $client->submit($form);

        $this->assertGreaterThan(0, $crawler->filter('html:contains("All done!")')->count());
    }
}