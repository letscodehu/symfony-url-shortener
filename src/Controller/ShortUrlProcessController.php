<?php

namespace App\Controller;

use App\Entity\ShortUrl;
use App\Form\CreateShortUrl;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlProcessController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    /**
     * ShortUrlProcessController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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
            $this->entityManager->persist($shortUrl);
            $this->entityManager->flush();
            return $this->redirectToRoute("short_url_processed");
        } else {
            return $this->render('home/index.html.twig', [
                "form" => $form->createView()
            ]);
        }
    }
}
