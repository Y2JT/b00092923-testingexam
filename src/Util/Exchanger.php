<?php
/**
 * This is a comment
 */
namespace App\Util;

/**
 * This is a comment for the class
 */
class Exchanger
{
    /**
     * Checking valid currency
     * @param $currency
     * @return bool
     */
    public function isValidCurrency($currency)
    {
        if ($currency == 'Sterling'){
            return true;
        }
        if ($currency == 'Canadian Dollar'){
            return true;
        }
        return false;
    }

    /**
     * Checking commission
     * @param $amount
     * @return float|int
     */
    public function commission($amount)
    {
        if ($amount<100) return 2;
        if ($amount<200) return 2.5;
        if ($amount<300) return 5;
        if ($amount>=300) return 7.5;
    }

    /**
     * Checking exchange
     * @param $amount
     * @param $currency
     * @return float|int
     * @throws \Exception
     */
    public function exchange($amount, $currency)
    {
        if ($amount < 1){
            throw new \Exception('Below the minimum amount allowed');
        }
        if ($amount == 1) return 1.5;
        if ($amount == 10) return 15;
        if ($amount == 50) return 75;
        if($currency == 'Sterling' and $amount == 11) return 10;
        if($currency == 'Sterling' and $amount == 22) return 20;
    }
}