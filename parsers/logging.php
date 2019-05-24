<?php

namespace parsers;

class logging extends \parser
{

    private static $canParseSearch = "/^(?:no\s+)?logging\s+(?:.+)/";

    private $type = "logging";
    private $description = "Logging configuration";
    private $enabled;
    private $logging;

    protected static function canParseSearch(){
        return self::$canParseSearch;
    }

    public function __construct($param)
    {
        parent::__construct($param);

        $regex = "/^(?:(no)\s+)?logging\s+(.+)/";
        preg_match($regex, $param, $matches);
        $this->enabled = ($matches[1] ? false : true);
        $this->logging = $matches[2];
    }

    
	public function jsonSerialize()
    {
        return 
        [
            'type'          => $this->type,
            'parameter'     => $this->parameter,
            'enabled'        => $this->enabled,
            'logging'       => $this->logging,
            'children'      => $this->children
        ];
    }
}
