<?php

namespace QuizApp\page;

/**
 * Rappresents a HTML block with all the childs associated
 */
class HTMLBlock
{
    /* HTML tag associated with the block */
    protected $tag;

    /* All the options of the block, like href, src, media, type, value ecc.. */
    protected $options;

    /* Blockchilds */
    protected $childs;


    /**
     * @param string $tag HTML block tag like a, img, div
     * @param array $options HTML options as an array ex. ["value" => "lorem", ...]
     */
    public function __construct(string $tag, array $options = array ()){
        $this->tag = $tag;
        $this->options = $options;
        $this->childs = array();
    }
    
    /**
     * Adds a child to this block
     * 
     * @param HTMLBlock $child child block to be added
     */
    public function addChild($child){
        if(! in_array(get_class($child), ["QuizApp\page\HTMLElement", "QuizApp\page\HTMLBlock"]) ){
            throw new \InvalidArgumentException("The child to add to a Block must be another HTMLBlock or HTMLElement.");
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

    public function getHTML($ident = 0) : string {
        $identString = "";
        for($i = 0; $i < $ident; $i++){
            $identString .= "\t";
        }

        $HTML = $identString . "<{$this->tag}";
        foreach($this->options as $key => $value){
            $HTML .= " {$key}=\"{$value}\"";
        }
        $HTML .= ">" . \PHP_EOL;

        foreach($this->childs as $child){
            if( is_string($child)){
               $HTML .= $identString . "\t" . $child;
            } else {
                $HTML .= $child->getHTML($ident + 1);
            }

            $HTML .= \PHP_EOL;
        }

        $HTML .= $identString . "</" . $this->tag . ">";

        return $HTML;
    }



}