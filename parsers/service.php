<?php

namespace parsers;

class service extends \parser
{

    private static $canParseSearch = "/^(?:no\s+)?service\s+(?:.+)/";

    private $type = "service";
    private $description = "Cisco services";
    private $enabled;
    private $service;

    protected static function canParseSearch(){
        return self::$canParseSearch;
    }

    public function __construct($param)
    {
        parent::__construct($param);

        $regex = "/^(?:(no)\s+)?service\s+(.+)/";
        preg_match($regex, $param, $matches);
        $this->enabled = ($matches[1] ? false : true);
        $this->service = $matches[2];
    }

    
	public function jsonSerialize()
    {
        return 
        [
            'type'          => $this->type,
            'parameter'     => $this->parameter,
            'enabled'       => $this->enabled,
            'service'       => $this->service,
            'children'      => $this->children
        ];
    }
}
