<?php

namespace QuizApp\question;

class RadioQuestion extends AbstractQuestion
{
    protected $options;

    public function __construct(int $number, string $question, array $options = array()){
        parent::__construct($number, $question);
        $this->options = $options;
        
    }

    public function getOptions() : array {
        return $this->options;
    }

    public function serialize(){
        return serialize([$this->number, $this->question, $this->options]);
    }

    public function unserialize($data){
        list($this->number, $this->question, $this->options) = unserialize($data);
    }

    public function getHTML(){
        $result = "<fieldset>" . \PHP_EOL;
        $result .= "\t" . $this->formatQuestionTitle() . \PHP_EOL;
        for( $i = 0; $i < count($this->options) - 1; $i++){
            $option = $this->options[$i];
            $result .= "\t" . "<input type=\"radio\" name=\"{$this->number}\" value=\"$option\">$option<br>" . \PHP_EOL;
        }

        $option = $this->options[count($this->options)-1];
        $result .= "\t" . "<input type=\"radio\" name=\"{$this->number}\" value=\"$option\">$option" . \PHP_EOL;
    
        $result .= "</fieldset>";

        return $result;
    }
}