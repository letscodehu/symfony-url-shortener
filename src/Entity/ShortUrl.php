<?php
declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Constraint\NotExists;

class ShortUrl
{

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Url
     */
    private string $target = "";

    /**
     * @var string|null
     * @Assert\Length(min = 8)
     * @NotExists
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