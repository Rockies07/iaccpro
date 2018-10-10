<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility
{
	public $user;
	
	/**
	 * Constructor
	 */

	/*
	function __construct()
	{
		$this->CI =& get_instance();
	}
	*/

	/**
	 * Check User Login
	 */
	function set_number($value)
	{
		if($value>0)
		{
			$result = "<font color='blue'>".number_format($value,2)."</font>";
		}
		else
		{
			$result = "<font color='red'>".number_format($value,2)."</font>";
		}
		return $result;
	}
}

/* End of file access.php */
/* Location: ./application/libraries/access.php */