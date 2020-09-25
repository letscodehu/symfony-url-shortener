<?php

namespace App\Controller;

use App\Entity\ShortUrl;
use App\Repository\ShortUrlRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlFollowController extends AbstractController
{
    private ShortUrlRepository $repository;

    /**
     * ShortUrlFollowController constructor.
     * @param ShortUrlRepository $repository
     */
    public function __construct(ShortUrlRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/{source}", name="short_url_follow")
     * @param string $source
     * @return RedirectResponse
     */
    public function index(string $source)
    {
        $shortUrl = $this->repository->find($source);
        if ($shortUrl == null) {
            $this->createNotFoundException("Unable to find a URL to redirect to.");
        }
        return $this->redirect($shortUrl->getTarget());
    }
}
