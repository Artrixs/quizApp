<?php

namespace QuizApp\page;

use QuizApp\page\Page;

class SimplePage extends Page
{
    public function run(){
        $this->generateCookies();
        $this->generateHeaders();
        echo "<html><head><title>{$this->title}</title></head> </html>";
    }
}