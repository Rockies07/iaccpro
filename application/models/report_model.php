<?php
class Report_model extends CI_Model
{
	private $table_name='transaction';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function win_loss($filter_from="",$filter_to="",$filter_project="",$filter_upline="")
	{
		$this->db->select('t.date as date, t.project_id, p.name as project_name, t.url_id, u.url as url, t.sh_id as sh_id, t.ag_id as ag_id, t.meb_id as meb_id, t.amount as amount, t.curr_id, c.code as curcode, t.cpybalance, t.formula as formula, t.ppt as ppt, t.description, c.rate as rate');
		$this->db->join('project as p', 'p.id = t.project_id', 'left');
		$this->db->join('currency as c', 'c.id = t.curr_id', 'left');
		$this->db->join('url as u', 'u.id = t.url_id', 'left');
		
		if($filter_project!="")
		{
			$this->db->where('t.project_id',$filter_project);
		}

		if($filter_upline!="")
		{
			$upline_arr=explode("-", $filter_upline);
			if($upline_arr[0] == "sh")
			{
				$sh_id=$upline_arr[1];

				$this->db->where('t.sh_id',$sh_id);
			}
			else
			{
				$ag_id=$upline_arr[1];

				$this->db->where('t.ag_id',$ag_id);
			}
		}

		if($filter_from != "0000-00-00" && $filter_from != "" && $filter_to != "0000-00-00" && $filter_to != "")
		{
			$filter_from = date('Y-m-d', strtotime(($filter_from)));
			$filter_to = date('Y-m-d', strtotime(($filter_to)));

			$this->db->where('t.date >=',$filter_from);
			$this->db->where('t.date <=',$filter_to);
		}

		$this->db->where('t.hidden','0');
		$query=$this->db->get($this->table_name.' as t');

		return $query->result();
	}
	
}


/* End of file Report_model.php */
/* Location: ./application/model/Report_model.php */