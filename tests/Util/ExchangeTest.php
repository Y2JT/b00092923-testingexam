<?php
namespace App\Util\Test;


use App\Util\Exchanger;
use PHPUnit\Framework\TestCase;

class ExchangeTest extends TestCase
{
    public function testValidCurrencySterling()
    {
        // Arrange
        $exchanger = new Exchanger();
        $currency = 'Sterling';

        // Act
        $result = $exchanger->isValidCurrency($currency);

        // Assert
        $this->assertTrue($result);
    }

    public function testValidCurrencyDollar()
    {
        // Arrange
        $exchanger = new Exchanger();
        $currency = 'Canadian Dollar';

        // Act
        $result = $exchanger->isValidCurrency($currency);

        // Assert
        $this->assertTrue($result);
    }


    public function testINVALIDCurrencyPunt()
    {
        // Arrange
        $exchanger = new Exchanger();
        $currency = 'Irish Punt';

        // Act
        $result = $exchanger->isValidCurrency($currency);

        // Assert
        $this->assertFalse($result);
    }


    public function testINVALIDCurrencyRandomString()
    {
        // Arrange
        $exchanger = new Exchanger();
        $currency = 'any old string';

        // Act
        $result = $exchanger->isValidCurrency($currency);

        // Assert
        $this->assertFalse($result);
    }

    public function testMinimumCommissionOne()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 1;
        $expectedResult = 2;

        // Act
        $result = $exchanger->commission($amount);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testMinimumCommissionFifty()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 50;
        $expectedResult = 2;

        // Act
        $result = $exchanger->commission($amount);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testMinimumCommissionMaxThreshold()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 99;
        $expectedResult = 2;

        // Act
        $result = $exchanger->commission($amount);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPercentageCommissionOneHundredMinThreshold()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 100;
        $expectedResult = 2.5;

        // Act
        $result = $exchanger->commission($amount);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }


    public function testPercentageCommissionTwoHundred()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 200;
        $expectedResult = 5;

        // Act
        $result = $exchanger->commission($amount);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testPercentageCommissionThreeHundred()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 300;
        $expectedResult = 7.5;

        // Act
        $result = $exchanger->commission($amount);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }



    /**
     * @expectedException \Exception
     */
    public function testExchangeTooLittleException()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 0.5;
        $currency = 'Canadian Dollar';

        // Act
        $result = $exchanger->exchange($amount, $currency);

        // Assert - FAIL - should not get here!
        $this->fail("Expected exception {\Exception} not thrown");
    }

    /**
     * @expectedException \Exception
     */
    public function testExchangeTooLittleMaxThresholdException()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 0.99;
        $currency = 'Canadian Dollar';

        // Act
        $result = $exchanger->exchange($amount, $currency);

        // Assert - FAIL - should not get here!
        $this->fail("Expected exception {\Exception} not thrown");
    }



    public function testExchangeMinThreshold()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 1;
        $currency = 'Canadian Dollar';
        $expectedResult = 1.5;

        // Act
        $result = $exchanger->exchange($amount, $currency);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }


    public function testExchangeDollarsTen()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 10;
        $currency = 'Canadian Dollar';
        $expectedResult = 15;

        // Act
        $result = $exchanger->exchange($amount, $currency);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testExchangeDollarsFifty()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 50;
        $currency = 'Canadian Dollar';
        $expectedResult = 75;

        // Act
        $result = $exchanger->exchange($amount, $currency);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }


    public function testExchangeSterlingEleven()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 11;
        $currency = 'Sterling';
        $expectedResult = 10;

        // Act
        $result = $exchanger->exchange($amount, $currency);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }


    public function testExchangeSterlingTwentyTwo()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 22;
        $currency = 'Sterling';
        $expectedResult = 20;

        // Act
        $result = $exchanger->exchange($amount, $currency);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }


    /**
     * @expectedException \Exception
     */
    public function testInvalidCurrencyException()
    {
        // Arrange
        $exchanger = new Exchanger();
        $amount = 0.5;
        $currency = 'some rubbish string';

        // Act
        $result = $exchanger->exchange($amount, $currency);

        // Assert - FAIL - should not get here!
        $this->fail("Expected exception {\Exception} not thrown");
    }

    /**
     * @dataProvider currencyCheckProvider
     */
    public function testCurrencyProvider($currency, $expectedResult)
    {
        // Arrange
        $exchanger = new Exchanger();;

        // Act
        $result = $exchanger->isValidCurrency($currency);

        // Assert
        $this->assertEquals($expectedResult, $result);

    }

    public function currencyCheckProvider()
    {
        return [
            ['Canadian Dollar', true],
            ['Sterling', true],
            ['Irish Punt', false]
        ];
    }


}
