<?php

namespace QuizApp\logging;

interface LoggerInterface
{
    /* Emergency Message */
    public function emergency($message, $context = array());

    /* AlertMessage */
    public function alert($message, $context = array());
    
    /* Critical Message */
    public function critical($message, $context = array());

    /* Error Message */
    public function error($message, $context = array());
    
    /* Warning Message */
    public function warning($message, $context = array());

    /* Notice Message */
    public function notice($message, $context = array());
    
    /* Info Message */
    public function info($message, $context = array());

    /* Debug Message */
    public function debug($message, $context = array());

    /* General log Message */
    public function log($level, $message, $context = array());

}