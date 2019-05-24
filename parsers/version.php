<?php

namespace parsers;

class version extends \parser
{

    private static $canParseSearch = "/^version\s+[0-9]+/";

    private $type = "version";
    private $description = "Cisco IOS version";
    private $version;

    protected static function canParseSearch(){
        return self::$canParseSearch;
    }

    public function __construct($param)
    {
        parent::__construct($param);

        $regex = "/^version\s+([0-9\-\.]+)/";
        preg_match($regex, $param, $matches);
        $this->version = $matches[1];
    }

    
	public function jsonSerialize()
    {
        return 
        [
            'type'          => $this->type,
            'parameter'     => $this->parameter,
            'version'       => $this->version,
            'children'      => $this->children
        ];
    }
}
