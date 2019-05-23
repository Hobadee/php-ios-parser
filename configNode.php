<?php

require_once('global.php');

class configNode{
	
	private $parameter;
	private $children = array();
	
	public function getParameter(){
		return $this->parameter;
	}
	
	public function addParameter($param, $level){
		if($level <= 0){
			$this->children[] = new configNode($param);
		}
		else{
			end($this->children);
			$lastIndex = key($this->children);

			// If we add extra indents without keys above, this handles that.
			if(!array_key_exists ($lastIndex, $this->children)){
				$this->children[$lastIndex] = new configNode("");
			}
			$this->children[$lastIndex]->addParameter($param, --$level);
		}
	}
	
	public function __construct($param){
		$this->parameter = $param;
	}
	
}
