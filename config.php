<?php

require_once('global.php');
require_once('configNode.php');
require_once('blocks.php');

class config implements JsonSerializable
{
	
	private $nodes = array();
	private $blocks;
	
	private $level_pattern = '/^(\s*)/';
	private $config_pattern = '/^\s*(.*?)\s*$/';
	private $comment_pattern = '/^\s*!/';
	private $newline_pattern = '/[\r\n]+/';
	
	public function addParameter($param, $level){
		if($level <= 0){
			$this->nodes[] = new configNode($param);
		}
		else{
			end($this->nodes);
			$lastIndex = key($this->nodes);
			$this->nodes[$lastIndex]->addParameter($param, --$level);
		}
	}
	
	
	public function __construct(){
		$this->blocks = new blocks();
	}
	
	public function addBlock(string $start, string $end, string $name = ''){
		$this->blocks->add($start, $end, $name = '');
	}
	
	
	public function load($config){
		$config = preg_split($this->newline_pattern, $config);
		
		foreach($config as $line){
			
			preg_match($this->level_pattern, $line, $level_matches);
			$level = strlen($level_matches[1]);
			
			preg_match($this->config_pattern, $line, $config_matches);
			$param = $config_matches[1];
			
			if($this->blocks->check($line)){
				$block = $line.$block;
			}
			else if(preg_match($this->comment_pattern, $line)){
				// Line is comment; Do nothing!
			}
			else{
				/*
				if($block){
					$param = $block;
				}
				*/
				$this->addParameter($param, $level);
				$block = null;
			}
		}
	}
	}

	public function jsonSerialize()
    {
        return 
        [
			'blocks'	=> $this->blocks,
			'nodes'		=> $this->nodes
        ];
    }
	
}
