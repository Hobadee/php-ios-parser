<?php
/**
 *  State machine to register block-types and keep track of if we are in a block of not.
 *  To be loaded as a form of middleware
 *  
 *  In middleware, for each line, iterate through all block objects until one is true or no more exist.
 */
class block implements JsonSerializable
{
	
	// Friendly name
	private $name;
	
	// Start and end pattern of the block
	private $startPattern;
	private $endPattern;
	
	// End deliminator of a block, if any.  Stored via regex var $1 in $startPattern
	private $endDeliminator;
	
	// If we are currently inside this block or not.
	private $inBlock = false;
	
	/**
	 *  @brief block constructor
	 *  
	 *  @param [string] $start Regular expression describing the start of the block
	 *  @param [string] $end Regular expression describing the end of the block
	 *  @return Return block object
	 */
	public function __construct(string $start, string $end, string $name = ''){
		$this->startPattern = $start;
		$this->endPattern = $end;
		$this->name = $name;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function inBlock(){
		return $this->inBlock;
	}
	
	/**
	 *  @brief Check if we are in a block or not
	 *  
	 *  @param [string] $line Line to parse
	 *  @return true if we are part of a block, false otherwise.
	 */
	public function check(string $line){
		if(!$this->inBlock){
			// We are not currently in a block.  Searching for the start of a block.
			$pattern = $this->startPattern;
		}else{
			// We are currently in a block.  Searching for the end of a block.
			$pattern = preg_replace('/\$1/', $this->endDeliminator, $this->endPattern);
		}
		if(preg_match($pattern, $line, $matches)){
			if(!$this->inBlock){
				// If this doesn't set, there was no extraction.  Don't care, supress errors.
				@$this->endDeliminator = $matches[1];
			}
			$this->blockToggle();
			return true;	// The last line is still part of the block!  If we are toggling inBlock, we are part of a block!
		}
		return $this->inBlock;
	}
	
	private function blockToggle(){
		if($this->inBlock){
			$this->inBlock = false;
		}else{
			$this->inBlock = true;
		}
	}

	public function jsonSerialize()
    {
        return 
        [
			'name'   => $this->name,
			'startPattern'	=> $this->startPattern,
			'endPattern'	=> $this->endPattern
        ];
    }
}
