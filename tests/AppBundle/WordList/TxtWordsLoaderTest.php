<?php

namespace Tests\AppBundle\WordList;

use AppBundle\WordList\JsonWordsLoader;
use AppBundle\WordList\TxtWordsLoader;
use PHPUnit\Framework\TestCase;

class TxtWordsLoaderTest extends TestCase
{
    public function testThatLoaderCanReadTxtFiles()
    {
        $fileToLoad = __DIR__.'/5_words_dummy_list.txt';

        $loader = new TxtWordsLoader();
        $loader->loadFile($fileToLoad);

        static::assertCount(5, $loader->getWords());
    }
}