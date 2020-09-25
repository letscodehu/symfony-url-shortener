<?php
declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Constraint\NotExists;
use App\Repository\ShortUrlRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShortUrlRepository::class)
 */
class ShortUrl
{

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Url
     * @ORM\Column(type="string", length=255)
     */
    private string $target = "";

    /**
     * @var string|null
     * @Assert\Length(min = 8)
     * @NotExists
     * @ORM\Column(type="string", length=36)
     * @ORM\Id
     */
    private ?string $source = null;

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget(string $target): void
    {
        $this->target = $target;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     */
    public function setSource(?string $source): void
    {
        $this->source = $source;
    }

}