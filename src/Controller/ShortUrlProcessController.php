<?php

namespace App\Controller;

use App\Entity\ShortUrl;
use App\Form\CreateShortUrl;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlProcessController extends AbstractController
{
    /**
     * @Route("/", name="short_url_process", methods={"POST"})
     */
    public function index(Request $request)
    {
        $shortUrl = new ShortUrl();
        $form = $this->createForm(CreateShortUrl::class, $shortUrl);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $shortUrl = $form->getData();
            // do something
            return $this->redirectToRoute("short_url_processed");
        } else {
            return $this->render('home/index.html.twig', [
                "form" => $form->createView()
            ]);
        }
    }
}
