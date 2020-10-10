<?php

namespace App\Tests;

use App\Entity\ShortUrl;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationTest extends WebTestCase
{
    public function testMissingTarget()
    {
        // GIVEN
        $validator = $this->createValidator();
        $shortUrl = new ShortUrl();
        // WHEN
        $violations = $validator->validate($shortUrl);
        // THEN
        $constraintViolation = $violations->get(0);
        self::assertEquals("This value should not be blank.", $constraintViolation->getMessage());
        self::assertEquals("target", $constraintViolation->getPropertyPath());
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
        $constraintViolation = $violations->get(0);
        self::assertEquals("This value is not a valid URL.", $constraintViolation->getMessage());
        self::assertEquals("target", $constraintViolation->getPropertyPath());
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
        $constraintViolation = $violations->get(0);
        self::assertEquals("This value is too short. It should have 8 characters or more.",
            $constraintViolation->getMessage());
        self::assertEquals("source", $constraintViolation->getPropertyPath());
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

    /**
     * @return ValidatorInterface
     */
    private function createValidator(): ValidatorInterface
    {
        self::bootKernel();
        /**
         * @var $validator ValidatorInterface
         */
        $validator = self::$kernel->getContainer()->get("validator");
        return $validator;
    }
}
