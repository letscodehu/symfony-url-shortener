<?php
declare(strict_types=1);
namespace App\Controller;


use App\Form\CreateShortUrl;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index() : Response
    {
        $form = $this->createForm(CreateShortUrl::class);
        return $this->render('home/index.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
