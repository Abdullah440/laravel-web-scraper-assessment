<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Goutte\Client;
use App\Models\Movie;
use Symfony\Component\DomCrawler\Crawler;

class MovieScrapingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info('Scraping job started');
            $client = new Client();
            $targetUrl = 'https://www.imdb.com/chart/top/';
            $crawler = $client->request('GET', $targetUrl);

            //Counter for control loop getting top ten movies
            $counter = 1;
            $crawler->filter('.cli-children')->each(function (Crawler $node) use (&$scraped_data, &$counter) {

                $str = explode(". ", $node->filter('.ipc-title__text')->text());
                $year = $node->filter('.cli-title-metadata-item')->first();
                $ratingNode = $node->filter('.ipc-rating-star')->first();
                $ratingnViews = explode("\u{A0}", $ratingNode->text());
                $rating = $ratingnViews[0];


                $url = $node->filter('a.ipc-title-link-wrapper')->attr('href');

                if ($counter <= 10) {
                    $data = [
                        'rank' => $str[0],
                        'year' => $year->text(),
                        'rating' => $rating,
                        'url' => "https://www.imdb.com".$url,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    Movie::updateOrInsert(
                        ['title' => $str[1]],
                        $data
                    );
                    $counter++;
                }
            });
            Log::info('Scraping job completed successfully');
        } catch (\Throwable $th) {
            Log::error('Scraping job failed', ['error' => $th->getMessage()]);
        }
    }
}
