<?php

namespace App\Controller;

use App\Repository\ShortUrlRepository;
use App\Service\ShortUrlService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlFollowController extends AbstractController
{
    private ShortUrlService $shortUrlService;

    /**
     * ShortUrlFollowController constructor.
     * @param ShortUrlService $shortUrlService
     */
    public function __construct(ShortUrlService $shortUrlService)
    {
        $this->shortUrlService = $shortUrlService;
    }

    /**
     * @Route("/{source<^(?!success).+>}", name="short_url_follow")
     * @param string $source
     */
    public function index(string $source)
    {
        $shortUrl = $this->shortUrlService->find($source);
        if ($shortUrl == null) {
            throw $this->createNotFoundException("Unable to find a URL to redirect to.");
        }
        return $this->redirect($shortUrl->getTarget());
    }
}
