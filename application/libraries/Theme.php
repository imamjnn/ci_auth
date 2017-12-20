<?php
class Theme{
	private $CI;
	function __construct(){
        $this->CI =&get_instance();
    }
	public function asset($file){
        
        return base_url('assets/'.$file);
    }
}