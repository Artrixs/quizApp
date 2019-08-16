<?php

namespace QuizApp\question;

class TextQuestion extends AbstractQuestion
{
    public function getHTML(){
        $result = "<fieldset>" . \PHP_EOL;
        $result .= "\t" . $this->formatQuestionTitle() . \PHP_EOL;
        $result .= "\t" . "<textarea name =\"{$this->number}\"></textarea>" . \PHP_EOL;
        $result .= "</fieldset>";

        return $result;
    }
}