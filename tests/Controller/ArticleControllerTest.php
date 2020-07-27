<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testListArticles()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    // public function testViewArticle()
    // {
    //     $client = static::createClient();

    //     $client->request('GET', '/article/5/show');

    //     $this->assertEquals(200, $client->getResponse()->getStatusCode());
    // }

    // public function testEditArticle()
    // {
    //     $client = static::createClient();

    //     $client->request('GET', '/article/5/edit');

    //     $this->assertEquals(200, $client->getResponse()->getStatusCode());
    // }
}
