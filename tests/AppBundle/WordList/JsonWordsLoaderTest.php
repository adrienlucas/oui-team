<?php

namespace Tests\AppBundle\WordList;

use AppBundle\WordList\JsonWordsLoader;
use PHPUnit\Framework\TestCase;

class JsonWordsLoaderTest extends TestCase
{
    public function testThatLoaderCanReadJsonFiles()
    {
        $fileToLoad = __DIR__.'/5_words_dummy_list.json';

        $loader = new JsonWordsLoader();
        $loader->loadFile($fileToLoad);

        static::assertCount(5, $loader->getWords());
    }

    /**
     * @expectedException \AppBundle\WordList\NotValidFormatException
     */
    public function testThatLoaderFailsToLoadNotJsonFiles()
    {
        $loader = new JsonWordsLoader();
        $loader->loadFile(__DIR__.'/not_valid_json.txt');
    }
}