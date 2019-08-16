<?php

namespace QuizApp;

/**
 * Object to incapsulate all data of the HTTP request to the site
 */
class Request
{
    /* Variables to store different values associated with the HTTP request */
    protected $method;

    protected $uri;

    protected $host;

    protected $getArray;

    protected $postArray;

    protected $sessionArray;

    protected $cookieArray;

    public function __construct(){
        session_start();

        $this->method   = $_SERVER['REQUEST_METHOD'];
        $this->uri      = $_SERVER['REQUEST_URI'];
        $this->host     = $_SERVER['HTTP_HOST'];
        $this->getArray = $_GET;

        if(isset($_POST)){
            $this->postArray = $_POST;
        } else {
            $this->postArray = array();
        }

        if(isset($_SESSION)){
            $this->sessionArray = $_SESSION;
        } else {
            $this->sessionArray = array();
        }

        if(isset($_COOKIE)){
            $this->cookieArray = $_COOKIE;
        } else {
            $this->cookieArray = array();
        }
    }


    public function getMethod() : string {
        return $this->method;
    }

    public function isGET() : bool {
        return $this->method == "GET";
    }

    public function isPOST() : bool {
        return $this->method == "POST";
    }
}