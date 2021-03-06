<?php
class Placeout_model extends CI_Model
{
	private $table_name='placeout';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_list($filter_status="")
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
		$query=$this->db->get($this->table_name.' as m');

		return $query->result_array();
	}
	
	function get_by_id($id)
	{
		$this->db->select('t.id as id, t.date as date, t.project_id, p.name as project_name, t.url_id, u.url as url, t.sh_id as sh_id, t.ag_id as ag_id, t.meb_id as meb_id, t.amount as amount, t.curr_id, c.code as curcode, t.cpybalance, t.formula as formula, t.ppt as ppt, t.description, c.rate as rate');
		$this->db->join('project as p', 'p.id = t.project_id', 'left');
		$this->db->join('currency as c', 'c.id = t.curr_id', 'left');
		$this->db->join('url as u', 'u.id = t.url_id', 'left');

		$this->db->where('t.id',$id);
		$query=$this->db->get('placeout as t');

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
	
	function get_placeout_count()
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


/* End of file Placeout_model.php */
/* Location: ./application/model/Placeout_model.php */