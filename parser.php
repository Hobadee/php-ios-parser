<?php

abstract class parser extends configNode
{
    /**
     * Checks if a parser can parse a parameter
     * 
     * @param string $param $parameter to be checked
     * @return Object New self() object if we can parse this parameter,
     * null otherwise
     */
//    abstract public static function canParse($param);

    protected static function canParseSearch(){
        throw new RuntimeException("Unimplemented");
    }

    public static function canParse($param){
        if(preg_match(static::canParseSearch(), $param)){
            return new static($param);
        }
        return null;
    }

}
