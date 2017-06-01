<?php

namespace AppBundle\Controller;

use AppBundle\Dummy\DummyFormType;
use AppBundle\Dummy\DummyModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Cache(smaxage=10)
     */
    public function indexAction(Request $request)
    {

        dump($this->get('app.youtube_fetcher')->fetchThumbnail('aaaa'));
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/form")
     */
    public function formAction(Request $request)
    {
        $model = new DummyModel("foobar");
        $form  = $this->createForm(DummyFormType::class, $model, [
            'show_the_super_field' => ($this->getUser() !== null && $this->getUser()->getUsername() === 'adrien')
        ]);

        $form->handleRequest($request);

        return $this->render('default/form.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/words/", name="words")
     */
    public function wordsAction()
    {
        $response = new JsonResponse($this->get('app.wordlist')->getWords());
    }

    /**
     * @Cache(smaxage=5)
     */
    public function highFrequencyReloadingAction()
    {
        return $this->render('default/high_frequency_reloading.html.Twig', []);
    }

    /**
     * @Route("/show-youtube-thumbnail", name="show_youtube_thumbnail")
     */
    public function showYoutubeThumbnailAction(Request $request)
    {
        if (!$request->query->has('videoId')) {
            throw new BadRequestHttpException('You should provide a videoId.');
        }
        $videoId = $request->get('videoId');

        $thumbnail = $this->get('app.youtube_fetcher')->fetchThumbnail($videoId);
        $this->getUser();
        return $this->render('default/youtube_thumbnail.html.twig', [
            'thumbnail' => $thumbnail,
        ]);
    }


}
