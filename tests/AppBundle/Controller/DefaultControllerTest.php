<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector;

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
        $client->enableProfiler();

        $videoId = 'aaaa';

        $url = sprintf('/show-youtube-thumbnail?videoId=%s', $videoId);
        $crawler = $client->request('GET', $url);

        static::assertEquals(200, $client->getResponse()->getStatusCode());

        $actualThumbnailLink = $crawler->filter('#container img')->attr('src');

        static::assertRegExp('/^https/', $actualThumbnailLink);
        static::assertContains($videoId, $actualThumbnailLink);

        /** @var LoggerDataCollector $logsCollector */
        $logsCollector = $client->getProfile()->getCollector('logger');
        $actualLogCount = 0;
        foreach($logsCollector->getLogs() as $log) {
            if($log['message'] === 'A youtube thumbnail has been requested.') {
                $actualLogCount++;
            }
        }

        static::assertSame(1, $actualLogCount, 'The log message was not found.');
    }
}
