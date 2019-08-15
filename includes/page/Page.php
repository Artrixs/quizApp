<?php

namespace QuizApp\page;

use QuizApp\page\Cookie;

/**
 * Abstract Class to rappresent a page and its view
 */
abstract class Page
{
    /* Array of cookies associated to the page*/
    protected $cookies;

    /* Array of HTTP headers associated to the page*/
    protected $headers;

    /* Page title */
    protected $title;

    /**
     * Initializes the page's variables
     */
    public function __construct(){
        $this->cookies = array();
        $this->headers = array();
    }

    /**
     * Adds a cookie to the page response
     * 
     * @param Cookie $cookie A Cookie object
     * 
     */
    public function addCookie( Cookie $cookie){
        array_push($this->cookies, $cookie);
    }

    /**
     * Adds a HTTP header to the page
     * 
     * @param string £header HTTP header as a string
     */
    public function addHeader( string $header){
        array_push($this->headers, $header);
    }

    /**
     * Sets the page title
     * 
     * @param string $title title of the page
     */
    public function setTitle($title){
        $this->title = $title;
    }

    /**
     * Main function to create the page and outputs it
     */
    abstract function run();

    /**
     * Sets the cookies associated with the page
     */
    protected function generateCookies(){
        foreach($this->cookies as $cookie){
            $cookie->sendCookie();
        }
    }

    /**
     * Sets the headers associated with the page
     */
    protected function generateHeaders(){
        foreach($this->headers as $header){
            header($header);
        }
    }

}