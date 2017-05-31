<?php

namespace AppBundle\WordList;


class TxtWordsLoader implements WordsLoaderInterface
{
    private $words = [];

    public function loadFile($file)
    {
        $newWords = explode(" ", file_get_contents($file));

        $this->words = array_merge($this->words, $newWords);
    }

    public function getWords()
    {
        return $this->words;
    }
}