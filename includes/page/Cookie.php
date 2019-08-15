<?php

namespace QuizApp\page;

/**
 * Class to represents a cookie
 */
class Cookie
{
    /* Name of the cookie */
    private $name;

    /* Value of the cookie */
    private $value;

    /* Expirations of the cookie in seconds */
    private $expires;

    /**
     *  Construct a simple cookie
     *
     * @param string $name name of the cookie
     * @param string $value cookie's value
     * @param int $expires cookie's expiration in seconds 
     */
    public function __construct(string $name, string $value = "", int $expires = 0){
        $this->name = $name;
        $this->value = $value;
        $this->expires = $expires;
    }

    /**
     * Sends the cookie, settting also the expiration
     */
    public function sendCookie(){
        if( $this->expires != 0){
            $time = time() + $this->expires;
        } else {
            $time = 0;
        }

        setcookie($this->name, $this->value, $time);
    }
}