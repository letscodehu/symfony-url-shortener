<?php

namespace App\Tests;

use App\Entity\ShortUrl;
use App\Service\ShortUrlService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationTest extends KernelTestCase
{
    public function setUp()
    {
        self::bootKernel();
    }

    public function testMissingTarget()
    {
        // GIVEN
        $validator = $this->createValidator();
        $shortUrl = new ShortUrl();
        // WHEN
        $violations = $validator->validate($shortUrl);
        // THEN
        $violation = $violations->get(0);
        self::assertEquals("target", $violation->getPropertyPath());
        self::assertEquals("This value should not be blank.", $violation->getMessage());
    }

    public function testNonUrlTarget()
    {
        // GIVEN
        $validator = $this->createValidator();
        $shortUrl = new ShortUrl();
        $shortUrl->setTarget("nonurl");
        // WHEN
        $violations = $validator->validate($shortUrl);
        // THEN
        $violation = $violations->get(0);
        self::assertEquals("target", $violation->getPropertyPath());
        self::assertEquals("This value is not a valid URL.", $violation->getMessage());
    }

    public function testProperUrlTarget()
    {
        // GIVEN
        $validator = $this->createValidator();
        $shortUrl = new ShortUrl();
        $shortUrl->setTarget("https://localhost/");
        // WHEN
        $violations = $validator->validate($shortUrl);
        // THEN
        self::assertEquals(0, $violations->count());
    }

    public function testTooShortSource()
    {
        // GIVEN
        $validator = $this->createValidator();
        $shortUrl = new ShortUrl();
        $shortUrl->setTarget("https://localhost/");
        $shortUrl->setSource("short");
        // WHEN
        $violations = $validator->validate($shortUrl);
        // THEN
        $violation = $violations->get(0);
        self::assertEquals("source", $violation->getPropertyPath());
        self::assertEquals("This value is too short. It should have 8 characters or more.",
            $violation->getMessage());
    }

    public function testProperSourceAndTarget()
    {
        // GIVEN
        $validator = $this->createValidator();
        $shortUrl = new ShortUrl();
        $shortUrl->setTarget("https://localhost/");
        $shortUrl->setSource("propersource");
        // WHEN
        $violations = $validator->validate($shortUrl);
        // THEN
        self::assertEquals(0, $violations->count());
    }

    public function testExistingSource()
    {
        // GIVEN
        $validator = $this->createValidator();
        $shortUrl = $this->existingShortUrl();
        // WHEN
        $violations = $validator->validate($shortUrl);
        // THEN
        $violation = $violations->get(0);
        self::assertEquals("source", $violation->getPropertyPath());
        self::assertEquals("The alias 'propersource' is already exists in our system. Please choose a different alias or let our system generate one.",
            $violation->getMessage());
    }

    /**
     * @return ValidatorInterface
     */
    private function createValidator(): ValidatorInterface
    {
        /**
         * @var $validator ValidatorInterface
         */
        $validator = self::$kernel->getContainer()->get("validator");
        return $validator;
    }

    /**
     * @return ShortUrlService
     */
    private function getShortUrlService(): ShortUrlService
    {
        /**
         * @var $service ShortUrlService
         */
        $service = self::$kernel->getContainer()->get('shortUrlService');
        return $service;
    }

    /**
     * @return ShortUrl
     */
    private function existingShortUrl(): ShortUrl
    {
        $shortUrl = new ShortUrl();
        $shortUrl->setTarget("https://localhost/");
        $shortUrl->setSource("propersource");
        $service = $this->getShortUrlService();
        $service->create($shortUrl, "http://localhost");
        return $shortUrl;
    }
}
