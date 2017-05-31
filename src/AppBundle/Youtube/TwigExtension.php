<?php

namespace AppBundle\Youtube;


class TwigExtension extends \Twig_Extension
{
    /**
     * @var YoutubeFetcher
     */
    private $youtubeFetcher;

    /**
     * @param YoutubeFetcher $youtubeFetcher
     */
    public function __construct(YoutubeFetcher $youtubeFetcher)
    {
        $this->youtubeFetcher = $youtubeFetcher;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'youtube';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_youtube_thumbnail', [$this, 'getYoutubeThumbnail']),
        ];
    }

    public function getYoutubeThumbnail($videoId, $thumbnailId = 0, $isHq = false)
    {
        $isHq = (int) $isHq;
        dump("isHq $isHq");
        dump("thumbnailId $thumbnailId");
        return $this->youtubeFetcher->fetchThumbnail($videoId);
    }
}
