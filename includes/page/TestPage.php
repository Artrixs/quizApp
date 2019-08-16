<?php

namespace QuizApp\page;


class TestPage extends Page{
    
    protected $questions;

    public function __construct(){
        parent::__construct();
        $this->questions = array();
    }

    public function addQuestion( $question){
        array_push($this->questions, $question);
    }

    protected function generateBody(){
        $form = new HTMLBlock("form");
        $questionsDiv = new HTMLBlock("div", ["class" => "questions"]);
        $form->addChild($questionsDiv);

        foreach($this->questions as $question){
            $questionsDiv->addChild( $question->getHTML() );
        }

        $btn = new HTMLElement("input", ["type" => "submit", "value" => "Consegna!"]);
        $form->addChild($btn);

        $this->body->addChild($form);
    }
}