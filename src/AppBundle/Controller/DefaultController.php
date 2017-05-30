<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // dump($this->get('app.youtube_fetcher')->fetchThumbnail('aaaa'));
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);

    }

    /**
     * @Route("/show-youtube-thumbnail", name="show_youtube_thumbnail")
     */
    public function showYoutubeThumbnailAction(Request $request)
    {
        if(!$request->query->has('videoId')) {
            throw new BadRequestHttpException('You should provide a videoId.');
        }
        $videoId = $request->get('videoId');

        $thumbnail = $this->get('app.youtube_fetcher')->fetchThumbnail($videoId);
        return $this->render('default/youtube_thumbnail.html.twig', [
            'thumbnail' => $thumbnail
        ]);
    }


}
