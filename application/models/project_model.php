<?php
class Project_model extends CI_Model
{
	private $table_name='project';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_list($filter_status="", $filter_mode="")
	{
		if($filter_status!="")
		{
			$this->db->where('status',$filter_status);
		}

		if($filter_mode!="")
		{
			$this->db->where('mode',$filter_mode);
		}
		$this->db->where('hidden','0');
		$query=$this->db->get($this->table_name);
		return $query->result_array();
	}

	function get_type_list($filter_status="", $filter_mode="")
	{
		if($filter_status!="")
		{
			$this->db->where('status',$filter_status);
		}

		if($filter_mode!="")
		{
			$this->db->where('mode',$filter_mode);
		}
		$this->db->where('hidden','0');
		$this->db->group_by('type');
		$this->db->order_by('type');
		$query=$this->db->get($this->table_name);
		return $query->result_array();
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
		$data = array(
           'hidden' => '1'
        );
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $data);
	}
	
	function get_project_count()
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


/* End of file Project_model.php */
/* Location: ./application/model/Project_model.php */