<?php

namespace QuizApp\question;

use QuizApp\page\HTMLElement;

abstract class AbstractQuestion implements \Serializable 
{
    protected $number;

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

    public function serialize() {
        return serialize([$this->number, $this->question]);
    }

    public function unserialize($data) {
        list($this->number, $this->question) = unserialize($data);
    }

    abstract public function getHTML();

    protected function getTitleHTML() : HTMLElement {
        $el = new HTMLElement("h4");
        $el->addText($this->number . " ". $this->question);
        return $el;
    }
}