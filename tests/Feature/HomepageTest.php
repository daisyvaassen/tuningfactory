<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_homepage_redirects_to_dashboard()
    {
        $response = $this->get('/');


    }
}
