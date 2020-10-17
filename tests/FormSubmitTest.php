<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormSubmitTest extends WebTestCase
{
    public function testFormSubmitRendersHomeIfInvalid()
    {
        // GIVEN
        $client = $this->visitHomePage();
        // WHEN
        $this->submitInvalidForm($client);
        // THEN
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Welcome to MiniURL');
    }

    public function testFormSubmitRedirectsToSuccessIfValid()
    {
        // GIVEN
        $client = $this->visitHomePage();
        // WHEN
        $this->submitValidForm($client);
        // THEN
        $this->assertResponseRedirects("/success");
    }

    public function testFormSubmitRedirectsToSuccessIfValidWithoutSource()
    {
        // GIVEN
        $client = $this->visitHomePage();
        // WHEN
        $this->submitValidFormWithoutSource($client);
        // THEN
        $this->assertResponseRedirects("/success");
    }

    public function testSuccessPageContainsRequiredInformation()
    {
        // GIVEN
        $client = $this->visitHomePage();
        // WHEN
        $this->submitValidForm($client);
        $client->followRedirect();
        // THEN
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains("#target_url", "https://google.com");
        $this->assertSelectorTextContains("#source_url", "http://localhost/propersource");
    }

    public function testCreatedUrlRedirectsToTarget()
    {
        // GIVEN
        $client = $this->visitHomePage();
        $this->submitValidForm($client);
        // WHEN
        $client->request("GET", "/propersource");
        // THEN
        $this->assertResponseRedirects("https://google.com");
    }

    /**
     * @return \Symfony\Bundle\FrameworkBundle\KernelBrowser
     */
    private function visitHomePage(): \Symfony\Bundle\FrameworkBundle\KernelBrowser
    {
        $client = static::createClient();
        $client->request('GET', '/');
        return $client;
    }

    /**
     * @param \Symfony\Bundle\FrameworkBundle\KernelBrowser $client
     */
    private function submitValidForm(\Symfony\Bundle\FrameworkBundle\KernelBrowser $client): void
    {
        $client->submitForm("create_short_url_submit", [
            "create_short_url[target]" => "https://google.com",
            "create_short_url[source]" => "propersource",
        ]);
    }

    /**
     * @param \Symfony\Bundle\FrameworkBundle\KernelBrowser $client
     */
    private function submitValidFormWithoutSource(\Symfony\Bundle\FrameworkBundle\KernelBrowser $client): void
    {
        $client->submitForm("create_short_url_submit", [
            "create_short_url[target]" => "https://google.com",
            "create_short_url[source]" => "",
        ]);
    }

    /**
     * @param \Symfony\Bundle\FrameworkBundle\KernelBrowser $client
     */
    private function submitInvalidForm(\Symfony\Bundle\FrameworkBundle\KernelBrowser $client): void
    {
        $client->submitForm("create_short_url_submit", [
            "create_short_url[target]" => "something",
            "create_short_url[source]" => "something",
        ]);
    }

}
