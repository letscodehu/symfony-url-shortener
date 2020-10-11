<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testHomePageFormRendering()
    {
        // GIVEN
        // WHEN
        $this->visitHomePage();
        // THEN
        $this->assertResponseIsSuccessful();
    }

    public function testHomePageTitle()
    {
        // GIVEN
        // WHEN
        $this->visitHomePage();
        // THEN
        $this->assertSelectorTextContains('h1', 'Welcome to MiniURL!');
    }

    public function testHomePageSubmitButton()
    {
        // GIVEN
        // WHEN
        $this->visitHomePage();
        // THEN
        $this->assertSelectorTextContains('button', 'Make miniURL!');
    }

    public function testHomePageFormFields()
    {
        // GIVEN
        // WHEN
        $this->visitHomePage();
        // THEN
        $this->assertSelectorExists("input#create_short_url_target", "The 'target' input field should exist!");
        $this->assertSelectorExists("input#create_short_url_source", "The 'source' input field should exist!");
    }

    private function visitHomePage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
    }

}
