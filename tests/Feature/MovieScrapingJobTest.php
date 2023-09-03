<?php

namespace Tests\Feature;

use App\Jobs\MovieScrapingJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieScrapingJobTest extends TestCase
{
    use RefreshDatabase; 

    public function testMovieScrapingJob()
    {
        Queue::fake();
        dispatch(new MovieScrapingJob());
        Queue::assertPushed(MovieScrapingJob::class);
    }
}
