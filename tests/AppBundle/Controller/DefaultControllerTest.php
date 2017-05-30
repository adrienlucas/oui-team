<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        static::assertEquals(200, $client->getResponse()->getStatusCode());
        static::assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testShowYoutubeThumbnail()
    {
        $client = static::createClient();
        $videoId = 'aaaa';
        //$url = $client->getContainer()->get('router')->generate('show_youtube_thumbnail', ['videoId' => $videoId]);
        $url = sprintf('/show-youtube-thumbnail?videoId=%s', $videoId);
        dump($url);
        $crawler = $client->request('GET', $url);

        static::assertEquals(200, $client->getResponse()->getStatusCode());

        $actualThumbnailLink = $crawler->filter('#container img')->attr('src');

        static::assertRegExp('/^https/', $actualThumbnailLink);
        static::assertContains($videoId, $actualThumbnailLink);
    }
}
