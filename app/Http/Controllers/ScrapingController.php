<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Movie;

class ScrapingController extends Controller
{

    public function scrape_movies(){
        $client = new Client();
        $targetUrl = 'https://www.imdb.com/chart/top/';
        if(!$targetUrl == 'https://www.imdb.com/chart/top/'){
            return response()->json(['error' =>  'target URL is invalid'], 500);

        }

        try {
            $crawler = $client->request('GET', $targetUrl);

            //Counter for control loop getting top ten movies
            $counter = 1;

            $crawler->filter('.cli-children')->each(function (Crawler $node) use (&$scraped_data, &$counter) {

                $str = explode(". ", $node->filter('.ipc-title__text')->text());
                $year = $node->filter('.cli-title-metadata-item')->first();
                $ratingNode = $node->filter('.ipc-rating-star')->first();
                $ratingnViews = explode("\u{A0}", $ratingNode->text());
                $rating = $ratingnViews[0];
                $views = $ratingnViews[1];

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
                            ['title' => $str[1]], // insertion based on movie title
                            $data
                        );

                    $counter++;
                }
            });




            return response()->json(['message' => 'Movies inserted or updated successfully']);

        } catch (\Throwable $th) {
            return response()->json(['error' =>  $th->getMessage()], 500);

        }

    }

    public function get_movies()
    {
        $data['movies'] = Movie::orderBy('rank')->get();
        return view('movies.listing', $data);
    }
}
