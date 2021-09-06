<?php
namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    /**
     * @Route("/", name="home")
     */
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks =$trickRepository->findAll();


        return $this->render('home.html.twig',[
            "tricks" => $tricks
        ]);
    }
}