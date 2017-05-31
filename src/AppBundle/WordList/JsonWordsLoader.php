<?php

namespace AppBundle\WordList;


class JsonWordsLoader implements WordsLoaderInterface
{
    private $words = [];

    public function loadFile($file)
    {
        $newWords = json_decode(file_get_contents($file));
        if($newWords === null) {
            throw new NotValidFormatException();
        }

        $this->words = array_merge($this->words, $newWords);
    }

    public function getWords()
    {
        return $this->words;
    }
}