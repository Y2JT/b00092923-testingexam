<?php
/**
 * This is a comment
 */
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Summary for the Controller class
 * @package App\Controller
 */
class DefaultController extends Controller
{
    /**
     * Index function
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $template = 'default/index.html.twig';
        $args = [];
        return $this->render($template, $args);
    }


}
