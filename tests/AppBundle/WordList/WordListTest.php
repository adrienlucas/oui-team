<?php

namespace Tests\AppBundle\WordList;

use AppBundle\WordList\WordList;
use AppBundle\WordList\WordsLoaderInterface;
use PHPUnit\Framework\TestCase;

class WordListTest extends TestCase
{
    public function testThatWordListContainsLoadedWords()
    {
        $loadedWords = ['tata', 'toto'];

        $wordList = new WordList();
        $wordList->addWords($loadedWords);

        self::assertSame($loadedWords, $wordList->getWords());
    }

    public function testThatWordListCanUseLoadersToLoadWords()
    {
        $loadedWords = ['tata', 'toto'];
        $fileToLoad = 'some_file_to_load.abc';

        $loader = $this->createMock(WordsLoaderInterface::class);
        $loader->expects(static::once())
            ->method('loadFile')
            ->with($fileToLoad);
        $loader->expects(static::once())
            ->method('getWords')
            ->willReturn($loadedWords);

        $wordList = new WordList();
        $wordList->addLoader($loader, 'abc');

        $wordList->addWordsByFile($fileToLoad);
        self::assertSame($loadedWords, $wordList->getWords());
    }
}