<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require __DIR__ . "/vendor/autoload.php";

use QuizApp\page\TestPage;
use QuizApp\page\Cookie;
use QuizApp\question\CheckBoxQuestion;
use QuizApp\question\RadioQuestion;
use QuizApp\question\TextQuestion;

use QuizApp\Request;



$test = new TestPage();
$test->setTitle("Quiz di prova");
$test->addStyleSheet("assets/styles/main.css");

$question1 = new CheckBoxQuestion(1,"Come ti chiami",["Arturo", "Rossana", "Misino"]);
$question2 = new RadioQuestion(2,"Come ti chiami",["Arturo", "Rossana", "Misino"]);
$question3 = new TextQuestion(3,"Come ti senti oggi?");

$test->addQuestion($question1);
$test->addQuestion($question2);
$text = serialize($question3);
$test->addQuestion(unserialize($text));


$test->run();
