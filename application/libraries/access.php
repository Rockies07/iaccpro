<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access
{
	public $user;
	
	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->CI =& get_instance();
		$auth = $this->CI->config->item('auth');
		
		$this->CI->load->helper('cookie');
		$this->CI->load->model('user_access_model');
		
		$this->user_access_model =& $this->CI->user_access_model;
	}
	
	/**
	 * Check User Login
	 */
	function login($username, $password)
	{
		$result=$this->user_access_model->get_login_admin($username);
		
		if(! $result)
		{
			$result=$this->user_access_model->get_login_staff($username);
			
			if(! $result)
			{
				$result=$this->user_access_model->get_login_member($username);
					
				if(! $result)
				{
					$result=$this->user_access_model->get_login_login($username);
					$level='login';
				}
				else
				{
					$level='member';
				}
			}
			else
			{
				$level='staff';
			}
		}
		else 
		{
			$level='admin';
		}
		
		if($result) //IF Result Found
		{
			//$password=md5($password);
			if($password===$result->password)
			{
				//Start Session
				$this->CI->session->set_userdata('user_id',$result->id);
				$this->CI->session->set_userdata('level_id',$level);
				$this->CI->session->set_userdata('username',$username);
				
				return TRUE;
			}
		}
		return FALSE;
	}
	
	/**
	 * Check is_login
	 */
	function is_login()
	{
		return (($this->CI->session->userdata('user_id'))?TRUE:FALSE);
	}
	
	/**
	 * get level
	 */
	function get_level()
	{
		return $this->CI->session->userdata('level_id');
	}
	
	/**
	 * get level
	 */
	function get_user()
	{
		return $this->CI->session->userdata('user_id');
	}
	
	function get_username()
	{
		return $this->CI->session->userdata('username');
	}
	
	/**
	 * Logout
	 */
	function logout()
	{
		$this->CI->session->unset_userdata('user_id');
	}
}

/* End of file access.php */
/* Location: ./application/libraries/access.php */