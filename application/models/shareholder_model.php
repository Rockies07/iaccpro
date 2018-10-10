<?php
class Shareholder_model extends CI_Model
{
	private $table_name='shareholder';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_list($filter_status="")
	{
		$this->db->select('*');
		if($filter_status!="")
		{
			$this->db->where('status',$filter_status);
		}
		$this->db->where('hidden','0');
		$query=$this->db->get($this->table_name);

		return $query->result_array();
	}
	
	function get_by_id($id)
	{
		$this->db->where('id',$id);
		$query=$this->db->get($this->table_name);
		return ($query->num_rows()>0)?$query->row():FALSE;
	}

	function get_project_by_id($id)
	{
		$this->db->where('sh_id',$id);
		$query=$this->db->get('sh_project_access');
		return $query->result();
	}

	function get_project_by_sh_id($id, $project_id)
	{
		$this->db->where('sh_id',$id);
		$this->db->where('project_id',$project_id);
		$query=$this->db->get('sh_project_access');
		return $query->num_rows();
	}
	
	function insert($value)
	{
		$this->db->insert($this->table_name, $value);
		return $this->db->insert_id();
	}

	function insert_project($value)
	{
		$this->db->insert('sh_project_access', $value);
		return $this->db->insert_id();
	}
	
	function update($id,$value)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $value);
	}

	function delete_shareholder_project($id, $project_id = "")
	{
		if($project_id!="")
		{
			$this->db->where('project_id', $project_id);
		}
		$this->db->where('sh_id', $id);
		$this->db->delete('sh_project_access');
	}
	
	function delete($id)
	{
		$data = array(
           'hidden' => '1'
        );
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $data);
	}
	
	function get_shareholder_count()
	{
		$query = $this->db->count_all_results($this->table_name);
		return $query;
	}
	
	function is_exist($field,$value)
	{
		$this->db->where($field,$value);
		$query=$this->db->get($this->table_name);
		return $query->num_rows();
	}
	
}


/* End of file Shareholder_model.php */
/* Location: ./application/model/Shareholder_model.php */