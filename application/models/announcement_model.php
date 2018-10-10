<?php
class Announcement_model extends CI_Model
{
	private $table_name='announcement';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_list($category)
	{
		$this->db->where('category',$category);
		$this->db->where('hidden', 0);

		return $this->db->get($this->table_name)->result_array();
	}
	
	function get_by_id($id)
	{
		$this->db->where($this->primary_key,$id);
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
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name,array('hidden'=>'1'));
	}
	
	function get_announcement_count()
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


/* End of file Announcement_model.php */
/* Location: ./application/model/Announcement_model.php */