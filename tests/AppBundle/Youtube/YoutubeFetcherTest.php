<?php

namespace Tests\AppBundle\Youtube;

use AppBundle\Youtube\YoutubeFetcher;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class YoutubeFetcherTest extends TestCase
{
    public function testFetchThumbnail()
    {
        $videoId = 'some-id';

        $youtubeFetcher = new YoutubeFetcher();
        $actualThumbnailLink = $youtubeFetcher->fetchThumbnail($videoId);

        static::assertRegExp('/^https/', $actualThumbnailLink);
        static::assertContains($videoId, $actualThumbnailLink);
    }

    public function testFetchThumbnailWithLogging()
    {
        $videoId = 'some-id';

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())
            ->method('info');

        $youtubeFetcher = new YoutubeFetcher();
        $youtubeFetcher->setLogger($logger);

        $actualThumbnailLink = $youtubeFetcher->fetchThumbnail($videoId);

        static::assertRegExp('/^https/', $actualThumbnailLink);
        static::assertContains($videoId, $actualThumbnailLink);
    }
}
