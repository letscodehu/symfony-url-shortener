<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlProcessedController extends AbstractController
{
    /**
     * @Route("/success", name="short_url_processed")
     */
    public function index()
    {
        return $this->render('short_url_processed/index.html.twig', [
            'controller_name' => 'ShortUrlProcessedController',
        ]);
    }
}
