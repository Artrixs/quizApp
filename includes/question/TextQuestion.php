<?php

namespace QuizApp\question;

use QuizApp\page\HTMLBlock;
use QuizApp\page\HTMLElement;

class TextQuestion extends AbstractQuestion
{
    public function getHTML(){
        $el = new HTMLBlock("fieldset");
        $el->addChild( $this->getTitleHTML() );
        
        $textarea = new HTMLElement("textarea", ["name" => $this->number]);

        $el->addChild( $textarea );
        return $el;
    }
}