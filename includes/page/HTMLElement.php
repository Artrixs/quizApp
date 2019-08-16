<?php

namespace QuizApp\page;

/**
 * Rappresents an HTML inline element
 */
class HTMLElement {

    /* HTML tag associated with the block */
    protected $tag;

    /* All the options of the element, like href, src, media, type, value ecc.. */
    protected $options;

    /* Element childs */
    protected $childs;

    /* TAG that reamins void */
    const VOID_TAG = ["area", "base", "br", "col", "command", "embed","hr", "img", "input", "keygen", "link", "meta", "param", "source", "track", "wbr"];


     /**
     * @param string $tag HTML element tag like a, img, div
     * @param array $options HTML options as an array ex. ["value" => "lorem", ...]
     */
    public function __construct(string $tag, array $options = array()){
        $this->tag = $tag;
        $this->options = $options;
        $this->childs = array();
    }

    /**
     * Adds a child to this element
     * 
     * @param HTMLBlock $child child element to be added
     */
    public function addChild(HTMLElement $child){
        if(in_array($this->tag, self::VOID_TAG)){
            throw new DomainException("{$this->tag} is a void tag, it can not have childs!");
        }
        array_push($this->childs, $child);
    }

    /**
     * Adds a text inside the block (as a child)
     * 
     * @param string $text
     */
    public function addText(string $text){
        array_push($this->childs, $text);
    }

    public function getHTML($ident = 0){
        $identString = "";
        for($i = 0; $i < $ident; $i++){
            $identString .= "\t";
        }

        $HTML = $identString . "<{$this->tag}";
        foreach($this->options as $key => $value){
            $HTML .= " {$key}=\"{$value}\"";
        }
        $HTML .= ">";

        foreach($this->childs as $child){
            if( is_string($child)){
               $HTML .= $child . " ";
            } else {
                $HTML .= $child->getHTML(0);
            }
        }

        if( ! in_array($this->tag, self::VOID_TAG)){
            $HTML .="</" . $this->tag . ">";
        }
        
        return $HTML;
    }
}