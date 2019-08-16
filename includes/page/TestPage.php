<?php

namespace QuizApp\page;

use QuizApp\question\AbstracQuestion;

class TestPage extends Page{
    
    protected $questions;

    public function __construct(){
        parent::__construct();
        $this->questions = array();
    }

    public function addQuestion( $question){
        array_push($this->questions, $question);
    }

    public function run(){
        foreach($this->questions as $question){
            $this->addHTML($question->getHTML());
        }
        
        echo $this->generatePageHTML();
    }
}