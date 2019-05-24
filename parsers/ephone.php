<?php

namespace parsers;

class ephone extends \parser
{

    private static $canParseSearch = "/^ephone\s+[0-9]+/";

    private $type = "ephone";
    private $description = "ephone Parser";
    private $ephoneNum;

    protected static function canParseSearch(){
        return self::$canParseSearch;
    }

    public function __construct($param)
    {
        parent::__construct($param);

        $regex = "/^ephone\s+([0-9]+)/";
        preg_match($regex, $param, $matches);
        $this->ephoneNum = $matches[1];
    }

    
	public function jsonSerialize()
    {
        return 
        [
            'type'          => $this->type,
            'parameter'     => $this->parameter,
            'ephoneNum'     => $this->ephoneNum,
            'children'      => $this->children
        ];
    }
}
