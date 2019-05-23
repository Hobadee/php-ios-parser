<?php

require_once('block.php');


/**
 *  Used for checking if a section of multi-line text is a single block of text
 *  rather than individual line items
 */
class blocks{
	
	private $blocks = array();
	
	public function add(string $start, string $end, string $name = ''){
		$this->blocks[] = new block($start, $end, $name);
	}
	
	public function check(string $line){
		foreach($this->blocks as $block){
			if($block->check($line)){
				return true;
			}
		}
		return false;
	}
	
	public function getBlock(){
		foreach($this->blocks as $block){
			if($block->inBlock()){
				return $block;
			}
		}
	}
	
}
