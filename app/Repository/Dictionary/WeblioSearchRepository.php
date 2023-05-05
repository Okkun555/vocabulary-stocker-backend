<?php

namespace App\Repository\Dictionary;

use App\Interface\Dictionary\WordSearchInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class WeblioSearchRepository implements WordSearchInterface
{
    /**
     * WeblioのWebページを叩いて、単語の意味を取得する
     *
     * @param string $word
     * @return array
     */
    public function request(string $word): array
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://ejje.weblio.jp/content/' . $word);
            $crawler = new Crawler($response->getBody()->getContents());

            // TODO:取得内容は今後調整する必要がありそう
            $content = $crawler->filter('#summary > div.summaryM.descriptionWrp > p > span.content-explanation.ej');

            return explode("、", $content->text());
        } catch (Exception $e) {

        }
    }
}
