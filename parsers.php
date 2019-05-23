<?php

class parsers
{

    private $parsers = array();

    public function add($parser){
        $this->parsers[] = $parser;
    }

    public function parse($param){
        foreach($this->parsers as $parser){
            if(($parser = $parser::canParse($param)) !== null){
                return $parser;
            }
        }
    }

}
