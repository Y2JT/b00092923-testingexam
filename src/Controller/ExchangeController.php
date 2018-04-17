<?php
/**
 * This is a comment
 */
namespace App\Controller;

use App\Util\Exchanger;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Comment for the class
 * @Route("/exchange", name="exchange_")
 */
class ExchangeController extends Controller
{
    /**
     * Comment for the index function
     * @Route("/", name="home")
     */
    public function index()
    {
        $template = 'exchange/index.html.twig';
        $args = [];
        return $this->render($template, $args);
    }


    /**
     * Comment for the processAction
     * @Route("/process", name="process")
     * @param Request $request
     */
    public function processAction(Request $request)
    {
        $amount = $request->request->get('amount');
        $currency = $request->request->get('currency');

        $exchanger = new Exchanger();

        try {
            $commission = $exchanger->commission($amount);
            $newAmount = $exchanger->exchange($amount, $currency);

            // success - answer template
            $template = 'exchange/result.html.twig';
            $args = [
                'amount' => $amount,
                'currency' => $currency,
                'commission' => $commission,
                'newAmount' => $newAmount,
            ];
        } catch (\Exception $e) {
            $template = 'exchange/error.html.twig';
            $args = [
                'message' => $e->getMessage()
            ];

        }

        return $this->render($template, $args);
    }
}
