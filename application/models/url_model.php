<?php
class Url_model extends CI_Model
{
	private $table_name='url';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_list($filter_status="")
	{
		$this->db->select('url.id,url.project_id, project.type, url.url, url.status');
		$this->db->join('project', 'project.id = url.project_id');
		if($filter_status!="")
		{
			$this->db->where('url.status',$filter_status);
		}
		$this->db->where('url.hidden','0');
		$query=$this->db->get($this->table_name);

		return $query->result_array();
	}
	
	function get_by_id($id)
	{
		$this->db->select('url.id,url.project_id, project.type, url.url, url.status');
		$this->db->join('project', 'project.id = url.project_id');
		$this->db->where('url.id',$id);
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
	
	function get_url_count()
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

	function get_url_by_project_id($id)
	{
		$this->db->where('project_id',$id);
		$this->db->where('hidden','0');
		$this->db->where('status','1');
		$query=$this->db->get($this->table_name);
		return $query->result();
	}
	
}


/* End of file Url_model.php */
/* Location: ./application/model/Url_model.php */