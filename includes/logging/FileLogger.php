<?php

namespace QuizApp\logging;

use QuizApp\logging\LogLevel;

class FileLogger implements LoggerInterface
{
    private $log_file;

    private $log_channel;

    private $log_level;

    const TAB = "\t";

    const LOG_LEVEL_NONE = 'none';

    /* Levels of loggin*/
    const LEVELS = [
        self::LOG_LEVEL_NONE => -1,
        LogLevel::DEBUG      => 0,
        LogLevel::INFO       => 1,
        LogLevel::NOTICE     => 2,
        LogLevel::WARNING    => 3,
        LogLevel::ERROR      => 4,
        LogLevel::CRITICAL   => 5,
        LogLevel::ALERT      => 6,
        LogLevel::EMERGENCY  => 7
    ]; 

    public function __construct(string $file, string $channel, string $level = LogLevel::DEBUG){
        $this->log_file = $file;
        $this->channel = $channel;
        $this->setLogLevel($level);
    }

    public function setLogLevel($level){

        if( !array_key_exists($level, self::LEVELS) ){
            throw new \DomainException("Log level $level is not a valid log level, must be one of (". implode(", ", self::LEVELS) . ")"); 
        } 

        $this->log_level = self::LEVELS[$level];
    }

    public function setChannel($channel) {
        $this->log_channel = $channel;
    }

    public function debug($message = '', $context = array()){
        if($this->logAtThisLevel(LogLevel::DEBUG)){
            $this->log(LogLevel::DEBUG, $message, $context);
        }
    }

    public function info($message = '', $context = array()){
        if($this->logAtThisLevel(LogLevel::INFO)){
            $this->log(LogLevel::INFO, $message, $context);
        }
    }

    public function NOTICE($message = '', $context = array()){
        if($this->logAtThisLevel(LogLevel::NOTICE)){
            $this->log(LogLevel::NOTICE, $message, $context);
        }
    }

    public function warning($message = '', $context = array()){
        if($this->logAtThisLevel(LogLevel::WARNING)){
            $this->log(LogLevel::WARNING, $message, $context);
        }
    }

    public function error($message = '', $context = array()){
        if($this->logAtThisLevel(LogLevel::ERROR)){
            $this->log(LogLevel::ERROR, $message, $context);
        }
    }

    public function critical($message = '', $context = array()){
        if($this->logAtThisLevel(LogLevel::CRITICAL)){
            $this->log(LogLevel::CRITICAL, $message, $context);
        }
    }

    public function alert($message = '', $context = array()){
        if($this->logAtThisLevel(LogLevel::ALERT)){
            $this->log(LogLevel::ALERT, $message, $context);
        }
    }

    public function emergency($message = '', $context = array()){
        if($this->logAtThisLevel(LogLevel::EMERGENCY)){
            $this->log(LogLevel::EMERGENCY, $message, $context);
        }
    }

    public function log( $level, $message = '', $context = array()){
        $pid = getmypid();
        $log_line = $this->formatLogLine($pid, $level, $message, $context);

        try{
            $fh = fopen($this->log_file, 'a');
            fwrite($fh, $log_line);
            fclose($fh);
        } catch (\Throwable $e) {
            throw new \RuntimeException("Could not open log file {$this->log_file} for writing log", 0, $e);
        }
    }

    private function logAtThisLevel($level) : bool 
    {
        return self::LEVELS[$level] >= $this->log_level;
    }

    private function formatLogLine($pid, $level, $message, $context) : string {
        $result =  $this->getTime()     . self::TAB . 
                   "[$pid]"             . self::TAB . 
                   "[{$this->channel}]" . self::TAB . 
                   "[$level]";

        $replacePairs = array();
        foreach( $context as $key => $value){
            $replacePairs["{. $key .}"] = $value;
        }

        strtr($message, $replacePairs);
        $result = $result . self::TAB . $message . \PHP_EOL;
        return $result;        
    }

    private function getTime() : string {
        return (new \DateTimeImmutable('now'))->format('Y-m-d H:i:s.u');
    }
}