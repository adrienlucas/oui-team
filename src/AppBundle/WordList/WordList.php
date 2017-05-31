<?php

namespace AppBundle\WordList;

class WordList
{
    private $words = [];
    private $loaders = [];

    public function getWords()
    {
        $words = [];
        foreach($this->loaders as $loader) {
            $words = array_merge($words, $loader->getWords());
        }

        return array_merge($this->words, $words);
    }

    public function addWords($words)
    {
        $this->words = array_merge($this->words, $words);
    }

    public function addLoader(WordsLoaderInterface $loader, $filetype)
    {
        $this->loaders[$filetype] = $loader;
    }

    public function addWordsByFile($file)
    {
        $explodedFilename = explode('.', $file);
        $fileExtension = end($explodedFilename);

        $this->loaders[$fileExtension]->loadFile($file);
    }
}