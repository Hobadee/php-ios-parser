<?php

namespace parsers;

class ephone_dn extends \parser
{

    private static $canParseSearch = "/^ephone-dn\s+[0-9]+/";

    private $name = "ephone-dn";
    private $description = "ephone-dn Parser";
    private $dnNum;
    private $dnOptions;

    protected static function canParseSearch(){
        return self::$canParseSearch;
    }

    
    public function __construct($param)
    {
        parent::__construct($param);

        $regex = "/^ephone-dn\s+([0-9]+)(?:\s+)?(.*)?/";
        preg_match($regex, $param, $matches);
        $this->dnNum = $matches[1];
        if(array_key_exists(2, $matches)){
            $this->dnOptions = $matches[2];
        }
    }
    

	public function jsonSerialize()
    {
        return 
        [
            'name'          => $this->name,
            'parameter'     => $this->parameter,
            'dnNum'         => $this->dnNum,
            'dnOptions'     => $this->dnOptions,
            'children'      => $this->children
        ];
    }
}
