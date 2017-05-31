<?php

namespace AppBundle\Youtube;

use Psr\Log\LoggerInterface;

class YoutubeFetcher
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function fetchThumbnail($videoId)
    {
        if ($this->logger !== null && !isset($toto)) {
            $this->logger->info('A youtube thumbnail has been requested.');
        }

        return sprintf(
            'https://img.youtube.com/vi/%s/0.jpg',
            $videoId
        );
    }
}
