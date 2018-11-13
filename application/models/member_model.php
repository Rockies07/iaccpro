<?php
class Member_model extends CI_Model
{
	private $table_name='member';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_list($filter_status="", $filter_project="")
	{
		$this->db->select('p.name as project_name,p.id as project_id,m.id as id, m.sh_id as sh_id, m.ag_id as ag_id, m.code as code,  m.password as password, m.url_id as url_id, u.url as url_name, m.status as status, m.remark as remark, m.currency_id as curr, c.code as curcode, m.ppt as ppt, m.ppt_formula as formula, m.createdate as createdate, m.createby as createby');
		$this->db->join('project as p', 'p.id = m.project_id', 'left');
		$this->db->join('currency as c', 'c.id = m.currency_id', 'left');
		$this->db->join('url as u', 'u.id = m.url_id', 'left');
		if($filter_status!="")
		{
			$this->db->where('m.status',$filter_status);
		}
		if($filter_project!="")
		{
			$this->db->where('m.project_id',$filter_project);
		}
		$this->db->where('m.hidden','0');
		$this->db->order_by('m.sh_id','ASC');
		$this->db->order_by('m.ag_id','ASC');
		$this->db->order_by('m.code','ASC');
		$query=$this->db->get($this->table_name.' as m');

		return $query->result_array();
	}
	
	function get_by_id($id)
	{
		$this->db->select('p.name as project_name,p.id as project_id,m.id as id, m.sh_id as sh_id, m.ag_id as ag_id, m.code as code,  m.password as password, m.url_id as url_id, u.url as url_name, m.status as status, m.remark as remark, m.currency_id as curr, c.code as curcode, m.ppt as ppt, m.ppt_formula as formula, m.createdate as createdate, m.createby as createby');
		$this->db->join('project as p', 'p.id = m.project_id', 'left');
		$this->db->join('currency as c', 'c.id = m.currency_id', 'left');
		$this->db->join('url as u', 'u.id = m.url_id', 'left');
		if($filter_status!="")
		{
			$this->db->where('m.status',$filter_status);
		}
		$this->db->where('m.hidden','0');
		$this->db->where('m.id',$id);
		$query=$this->db->get($this->table_name.' as m');
		return ($query->num_rows()>0)?$query->row():FALSE;
	}

	function get_by_code($id)
	{
		$this->db->select('p.name as project_name,p.id as project_id,m.id as id, m.sh_id as sh_id, m.ag_id as ag_id, m.code as code,  m.password as password, m.url_id as url_id, u.url as url_name, m.status as status, m.remark as remark, m.currency_id as curr, c.code as curcode, m.ppt as ppt, m.ppt_formula as formula, m.createdate as createdate, m.createby as createby');
		$this->db->join('project as p', 'p.id = m.project_id', 'left');
		$this->db->join('currency as c', 'c.id = m.currency_id', 'left');
		$this->db->join('url as u', 'u.id = m.url_id', 'left');
		if($filter_status!="")
		{
			$this->db->where('m.status',$filter_status);
		}
		$this->db->where('m.hidden','0');
		$this->db->where('m.code',$id);
		$query=$this->db->get($this->table_name.' as m');
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
	
	function get_member_count()
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


/* End of file Member_model.php */
/* Location: ./application/model/Member_model.php */