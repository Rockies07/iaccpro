<?php
class Account_model extends CI_Model
{
	private $table_name='account';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_list($filter_status="")
	{
		$this->db->select('*');
		$this->db->join('currency', 'currency.id = account.currency_id');
		if($filter_status!="")
		{
			$this->db->where('account.status',$filter_status);
		}
		$this->db->where('account.hidden','0');
		$query=$this->db->get($this->table_name);

		return $query->result_array();
	}
	
	function get_by_id($id)
	{
		$this->db->select('*');
		$this->db->join('currency', 'currency.id = account.currency_id');
		$this->db->where('account.id',$id);
		$query=$this->db->get($this->table_name);
		return ($query->num_rows()>0)?$query->row():FALSE;
	}
	
	function insert($value)
	{
		$this->db->insert($this->table_name, $value);
		return $this->db->insert_id();
	}
	
	function update($id,$value)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $value);
	}
	
	function delete($id)
	{
		$data = array(
           'hidden' => '1'
        );
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $data);
	}
	
	function get_account_count()
	{
		$query = $this->db->count_all_results($this->table_name);
		return $query;
	}
	
	function is_exist($field,$value)
	{
		$this->db->where($field,$value);
		$query=$this->db->get($this->table_name);
		return ($query->num_rows()>0)?$query->row():FALSE;
	}
	
}


/* End of file Account_model.php */
/* Location: ./application/model/Account_model.php */