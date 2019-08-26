<?php

namespace QuizApp\question;

use QuizApp\page\HTMLElement;

/**
 * Abstract class to rappresent a question
 */
abstract class AbstractQuestion
{
    /* Order number of the question */
    protected $number;

    /* Text of the question */
    protected $question;

    
    public function __construct(int $number, string $question){
        $this->number = $number;
        $this->question = $question;
    }

    public function getNumber() : int{
        return $this->number;
    }

    public function getQuestion(): string {
        return $this->question;
    }

    abstract public function getHTML();

    protected function getTitleHTML() : HTMLElement {
        $el = new HTMLElement("h4");
        $el->addText($this->number . " ". $this->question);
        return $el;
    }
}