<?php

namespace QuizApp\question;

use QuizApp\page\HTMLBlock;
use QuizApp\page\HTMLElement;

class RadioQuestion extends AbstractQuestion
{
    protected $options;

    public function __construct(int $number, string $question, array $options = array()){
        parent::__construct($number, $question);
        $this->options = $options;
        
    }

    public function getOptions() : array {
        return $this->options;
    }

    public function serialize(){
        return serialize([$this->number, $this->question, $this->options]);
    }

    public function unserialize($data){
        list($this->number, $this->question, $this->options) = unserialize($data);
    }

    public function getHTML(){
        $el = new HTMLBlock("fieldset");

        $el->addChild( $this->getTitleHTML() );

        for( $i = 0; $i < count($this->options) - 1; $i++){
            $option = new HTMLElement("input", ["type" => "radio",
                                                "name" => $this->number,
                                                "value" => $this->options[$i]]);
            $option->addText($this->options[$i] . "<br>");
            $el->addChild($option);
        }

        $option = new HTMLElement("input", ["type" => "radio",
                                            "name" => $this->number,
                                            "value" => $this->options[count($this->options) -1]
                                            ]);
        $option->addText($this->options[count($this->options) - 1]);
        $el->addChild($option);

        return $el;
    }
}