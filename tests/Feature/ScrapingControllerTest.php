<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScrapingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetMovies()
    {
        $response = $this->get('/movies');

        $response->assertStatus(200);

        $response->assertViewIs('movies.listing');
        $response->assertViewHas('movies');
    }
}
