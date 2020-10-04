<?php


namespace App\Service;


class ShortUrlResult
{
    private string $target;
    private string $source;
    private int $targetLength;
    private int $sourceLength;

    /**
     * ShortUrlResult constructor.
     * @param string $target
     * @param string $source
     * @param int $targetLength
     * @param int $sourceLength
     */
    public function __construct(string $target, string $source, int $targetLength, int $sourceLength)
    {
        $this->target = $target;
        $this->source = $source;
        $this->targetLength = $targetLength;
        $this->sourceLength = $sourceLength;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return int
     */
    public function getTargetLength(): int
    {
        return $this->targetLength;
    }

    /**
     * @return int
     */
    public function getSourceLength(): int
    {
        return $this->sourceLength;
    }

}