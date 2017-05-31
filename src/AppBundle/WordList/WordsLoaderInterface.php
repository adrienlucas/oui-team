<?php

namespace AppBundle\WordList;


interface WordsLoaderInterface
{
    public function loadFile($file);
    public function getWords();
}