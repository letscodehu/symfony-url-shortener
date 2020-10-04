<?php

namespace App\Controller;

use App\Entity\ShortUrl;
use App\Form\CreateShortUrl;
use App\Repository\ShortUrlRepository;
use App\Service\ShortUrlService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlProcessController extends AbstractController
{
    private ShortUrlService $shortUrlService;

    /**
     * ShortUrlProcessController constructor.
     * @param ShortUrlService $shortUrlService
     */
    public function __construct(ShortUrlService $shortUrlService)
    {
        $this->shortUrlService = $shortUrlService;
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
            $result = $this->shortUrlService->create($shortUrl, $request->getSchemeAndHttpHost());
            $this->addFlash("target", $result->getTarget());
            $this->addFlash("source", $result->getSource());
            $this->addFlash("targetLength", $result->getTargetLength());
            $this->addFlash("sourceLength", $result->getSourceLength());
            return $this->redirectToRoute("short_url_processed");
        } else {
            return $this->render('home/index.html.twig', [
                "form" => $form->createView()
            ]);
        }
    }
}
