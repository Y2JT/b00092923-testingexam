<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ExchangeControllerTest extends WebTestCase
{
    public function testHomepageStatusOkay()
    {
        // arrange
        $url = '/exchange/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $expectedResult = Response::HTTP_OK;

        // assert
        $client->request($httpMethod, $url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        // act
        $this->assertEquals($expectedResult, $resultStatusCode);
    }

    public function testFormSubmitsWithValidData()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/exchange/';
        $client = static::createClient();
        $client->request($httpMethod, $url);
        $expectedContent = 'exchange submission';
        $expectedContentLower = strtolower($expectedContent);

        $amount = 22;
        $currency = 'Sterling';

        // click link 'about'
        $buttonName = 'exchange_submit';

        // Act
        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'amount' => $amount,
            'currency' => $currency,
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        // assert
        $this->assertContains($expectedContentLower, $contentLowerCase);
    }

    public function testFormSubmitsWithValidDataAndSeeCorrectResult()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/exchange/';
        $client = static::createClient();
        $client->request($httpMethod, $url);


        $amount = 22;
        $currency = 'Sterling';
        $expectedResultString = 2 . '';

        // click link 'about'
        $buttonName = 'exchange_submit';

        // Act
        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'amount' => $amount,
            'currency' => $currency,
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        // assert
        $this->assertContains($expectedResultString, $contentLowerCase);
    }

    public function testFormSubmitsWithValidDataWithCorrectCommission()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/exchange/';
        $client = static::createClient();
        $client->request($httpMethod, $url);
        $expectedContent = 'commission charge = &euro; 2';
        $expectedContentLower = strtolower($expectedContent);

        $amount = 99;
        $currency = 'Sterling';

        // click link 'about'
        $buttonName = 'exchange_submit';

        // Act
        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'amount' => $amount,
            'currency' => $currency,
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        // assert
        $this->assertContains($expectedContentLower, $contentLowerCase);
    }

    public function testFormSubmitsWithValidDataWithCorrectNewCurrencyAmount()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/exchange/';
        $client = static::createClient();
        $client->request($httpMethod, $url);
        $expectedContent = 'sterling 15';
        $expectedContentLower = strtolower($expectedContent);

        $amount = 10;
        $currency = 'Sterling';

        // click link 'about'
        $buttonName = 'exchange_submit';

        // Act
        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'amount' => $amount,
            'currency' => $currency,
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        // assert
        $this->assertContains($expectedContentLower, $contentLowerCase);
    }

    public function testFormSubmitsWithInvalidData()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/exchange/';
        $client = static::createClient();
        $client->request($httpMethod, $url);
        $expectedContent = 'Money Exchange error';
        $expectedContentLower = strtolower($expectedContent);

        $amount = 0.1;
        $currency = 'punt';

        // click link 'about'
        $buttonName = 'exchange_submit';

        // Act
        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'amount' => $amount,
            'currency' => $currency,
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        // aassert
        $this->assertContains($expectedContentLower, $contentLowerCase);
    }

}