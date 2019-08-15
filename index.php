<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require __DIR__ . "/vendor/autoload.php";

use QuizApp\page\SimplePage;
use QuizApp\page\Cookie;

$index = new SimplePage();
$index->addCookie(new Cookie("TestExpiration", "test", 60));
$index->run();


