<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @var Twig\Environnement
     */
    private $tiwg;

    public function __construct(Environment $twig) 
    {
        $this->twig = $twig;
    }

    public function index(): Response
    {
        return $this->render('home.html.twig');
    }
}