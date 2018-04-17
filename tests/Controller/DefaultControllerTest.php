<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class DefaultControllerTest extends WebTestCase
{
    public function testHomePageHasLinkToExchangePage()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/';
        $client = static::createClient();
        $crawler = $client->request($httpMethod, $url);
        $expectedContent = 'Currency Exchange Form';
        $expectedContentLower = strtolower($expectedContent);

        // click link 'exchange'
        $linkText = 'exchange';
        $link = $crawler->selectLink($linkText)->link();

        // act
        $client->click($link);
        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        // aassert
        $this->assertContains($expectedContentLower, $contentLowerCase);

    }
}