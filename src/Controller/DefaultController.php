<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
 class DefaultController extends Controller
{
    /**
     * @Route("/", name="default_index")
     */
    public function index()
    {
        //return $this->render('default.html.twig');
        return $this->redirect('/package');
    }
}
