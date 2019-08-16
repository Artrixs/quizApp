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

    /* HTML of the page head */
    protected $headHTML;

    /* HTML  of the page body */
    protected $bodyHTML;

    /* Meta charset of the page */
    protected $metaCharset;

    /* Meta Description of the page */
    protected $metaDescription;

    /* Meta Keywords of the page */
    protected $metaKeywords;

    /* Meta Author of the page */
    protected $metaAuthor;

    /* Meta links tag */
    protected $metaLinks;

   
    /**
     * Initializes the page's variables
     */
    public function __construct(){
        $this->cookies = array();
        $this->headers = array();
        $this->metaLinks = array();
        $this->headHTML = "";
        $this->bodyHTML = "";

        //By defualt use UTF-8
        $this->metaCharset = "UTF-8";
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
     * Adds a link type tag to the page
     * 
     * @param string $rel relations between the document and page
     * @param string $type media type of the linked document
     * @param string $url location of the linked document
     */
    public function addLink(string $rel, string $type, string $url){
        array_push($this->metaLinks, [$rel, $type, $url]);
    }

    /**
     * Adds a stylesheet to the page
     * @param string $url location from base directory
     */
    public function addStyleSheet(string $url){
        $this->addLink("stylesheet", "text/css", "http://" .$_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] . $url);
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
     * Adds the HTML to the body of the page
     * 
     * @param $html HTML to be inserted into the page
     */
    public function addHTML($html){
        $this->bodyHTML .= "\n{$html}";
    }

     /**
     * Sets the charset of the HTML page
     * 
     * @param string $charset 
    */
    public function setCharset($charset){
        $this->metaCharset = $charset;
    }

    /**
     * Sets the description of the HTML page
     * 
     * @param string $description
    */
    public function setDescription($description){
        $this->metaDescription = $description;
    }

    /**
     * Sets the keywords of the HTML page
     * 
     * @param string $keywords list of comma separeted keywords
    */
    public function setKeywords($keywords){
        $this->metaKeywords = $keywords;
    }

    /**
     * Sets the author of the HTML page
     * 
     * @param string $author
    */
    public function setAuthor($author){
        $this->metaAuthor = $author;
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

    /**
     * Creates the HTML text inside the head tag, and puts it into the headHTML.
     */
    protected function genereateHeadHTML(){
        $HTML = "<!DOCTYPE html>" . \PHP_EOL;
        $HTML .= "<html lang=it>" . \PHP_EOL;
        $HTML .= "<head>\n";
        
        if(isset($this->title)){
            $HTML .= "<title>{$this->title}</title>\n"; 
        }

        if(isset($this->metaCharset)){
            $HTML .= '<meta charset="' . $this->metaCharset . "\">\n"; 
        }

        if(isset($this->metaDescription)){
            $HTML .= '<meta name="description" content="' . $this->metaDescription . "\">\n"; 
        }

        if(isset($this->metaKeywords)){
            $HTML .= '<meta name="keywords" content="' . $this->metaKeywords . "\">\n"; 
        }

        if(isset($this->metaAuthor)){
            $HTML .= '<meta name="author" content="' . $this->metaAuthor . "\">\n"; 
        }
 
        //Viewport
        $HTML .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . \PHP_EOL;

        foreach($this->metaLinks as $link){
            list($rel, $type, $url) = $link;
            $HTML .= '<link rel="'. $rel . '" type="' . $type . '" href="' . $url . '">' . \PHP_EOL; 
        }

        $HTML .= "</head>";
        $this->headHTML = $HTML;
    }

    protected function generatePageHTML(){
        $this->genereateHeadHTML();
        $HTML = $this->headHTML;
        $HTML .= "<body>" . \PHP_EOL;
        $HTML .= $this->bodyHTML;
        $HTML .= "</body>" . \PHP_EOL;
        $HTML .= "</html>";

        return $HTML;
    }

}