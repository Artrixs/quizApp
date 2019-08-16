<?php

namespace QuizApp\page;

/**
 * Class to rappresent a page with a quiz/survery and its questions
 * @extends Page
 */
class TestPage extends Page{
    
    /* Array of questions in the test */
    protected $questions;

    public function __construct(){
        parent::__construct();
        $this->questions = array();
    }

    /**
     * Adds a question to the page
     * 
     * @param $question Question to add
     */
    public function addQuestion( $question){
        array_push($this->questions, $question);
    }

    /**
     * Generates the HTML body structure creating all questions and the form.
     */
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