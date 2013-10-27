<?php

namespace GlobeSoft\ScrumManagerWebBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContentControllerTest extends WebTestCase{

    public function testPagesAreAccessible() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful());

        $crawler = $client->request('GET', '/home');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testClickingOnNavigationButtonsIsCorrect() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $link = $crawler->filter('#logo')->link();
        $client->click($link);
        $this->assertTrue($client->getResponse()->isSuccessful());

        $crawler = $client->request('GET', '/');
        $link = $crawler->filter('a:contains("Home")')->link();
        $client->click($link);
        $this->assertTrue($client->getResponse()->isSuccessful());

    }
}