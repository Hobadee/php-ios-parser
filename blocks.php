<?php

require_once('block.php');


/**
 *  Used for checking if a section of multi-line text is a single block of text
 *  rather than individual line items
 */
class blocks implements JsonSerializable
{
	
	private $blocks = array();
	
	public function add(string $start, string $end, string $name = ''){
		$this->blocks[] = new block($start, $end, $name);
	}
	
	/**
	 * @brief Check if we have any open blocks or not.
	 * 
	 * @param string $line Line to parse
	 * @return int 0 if not in a block, 1 if in a block, -1 if returning from a block.
	 */
	public function check(string $line){
		foreach($this->blocks as $block){
			$check = $block->check($line);
			if($check){
				return $check;
			}
		}
		return 0;
	}
	
	public function getBlock(){
		foreach($this->blocks as $block){
			if($block->inBlock()){
				return $block;
			}
		}
	}

	public function jsonSerialize()
    {
        return 
        [
            'blocks'   => $this->blocks
        ];
    }
	
}
