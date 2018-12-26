<?php
class Report_model extends CI_Model
{
	private $table_name='placeout';
	private $primary_key='id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function win_loss($filter_from="",$filter_to="",$filter_project="",$filter_upline="")
	{
		$this->db->select('t.id as id, t.date as date, t.project_id, p.name as project_name, t.url_id, u.url as url, t.sh_id as sh_id, t.ag_id as ag_id, t.meb_id as meb_id, t.amount as amount, t.curr_id, c.code as curcode, t.cpybalance, t.duebalance, t.formula as formula, t.ppt as ppt, t.description, c.rate as rate');
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

	function total_win_loss($filter_from="",$filter_to="",$filter_project="",$filter_upline="", $currency="")
	{
		$this->db->select('c.name as currency_name,sum(t.cpybalance) as amount,sum(t.duebalance) as duebalance');
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

		if($currency!="")
		{
			$this->db->where('c.id', $currency);
		}

		if($filter_from != "0000-00-00" && $filter_from != "" && $filter_to != "0000-00-00" && $filter_to != "")
		{
			$filter_from = date('Y-m-d', strtotime(($filter_from)));
			$filter_to = date('Y-m-d', strtotime(($filter_to)));

			$this->db->where('t.date >=',$filter_from);
			$this->db->where('t.date <=',$filter_to);
		}

		$this->db->where('t.hidden','0');
		$this->db->having('amount !=','0');
		$this->db->group_by('c.code','ASC');
		$query=$this->db->get($this->table_name.' as t');

		return $query->result();
	}

	function delete($id)
	{
		$data = array(
           'hidden' => '1'
        );
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $data);
	}

	function get_transaction_currency($id, $level)
	{
		if($level=="sh")
		{
			$sql="SELECT p.curr_id as curr_id, c.code as curcode from placeout p,currency c where p.sh_id='$id' and p.curr_id=c.id group by curr_id
					UNION 
					SELECT t.curr_id as curr_id, c.code as curcode from transaction t, currency c where t.sh_id='$id' and t.curr_id=c.id  group by curr_id";
		}
		else
		{
			$sql="SELECT p.curr_id as curr_id, c.code as curcode from placeout p,currency c where p.ag_id='$id' and p.curr_id=c.id group by curr_id
					UNION 
					SELECT t.curr_id as curr_id, c.code as curcode from transaction t, currency c where t.ag_id='$id' and t.curr_id=c.id  group by curr_id";
		}

		$query=$this->db->query($sql);
		return $query->result();
	}

	function get_total_amount($id,$curr,$level)
	{
		if($level=="sh")
		{
			$sql="SELECT SUM(duebalance) as amount from placeout where sh_id='$id' and curr_id='$curr' and hidden='0'";
			$amount_placeout=$this->db->query($sql)->row()->amount;

			$sql="SELECT SUM(amount) as amount from transaction where sh_id='$id' and curr_id='$curr' and hidden='0'";
			$amount_transaction=$this->db->query($sql)->row()->amount;
		}
		else
		{
			$sql="SELECT SUM(duebalance) as amount from placeout where ag_id='$id' and curr_id='$curr' and hidden='0'";
			$amount_placeout=$this->db->query($sql)->row()->amount;

			$sql="SELECT SUM(amount) as amount from transaction where ag_id='$id' and curr_id='$curr' and hidden='0'";
			$amount_transaction=$this->db->query($sql)->row()->amount;
		}

		return $amount_placeout+$amount_transaction;
	}

	function get_balance_detail($id, $curr,$level,$filter_from="",$filter_to="",$filter_project="")
	{
		if($filter_from != "0000-00-00" && $filter_from != "" && $filter_to != "0000-00-00" && $filter_to != "")
		{
			$filter_from = date('Y-m-d', strtotime(($filter_from)));
			$filter_to = date('Y-m-d', strtotime(($filter_to)));

			$filter_sql = " AND t.date between '$filter_from' AND '$filter_to' ";
		}

		if($filter_project!="")
		{
			$filter_sql = " AND t.project_id='$filter_project' ";
		}

		if($level=="sh")
		{
			$sql="SELECT t.date as date, t.project_id as project_id, p.name as project_name, t.url_id as url_id, u.url as url, t.sh_id as sh_id, t.ag_id as ag_id, t.meb_id as meb_id, t.amount as amount, t.curr_id as curr_id, c.code as curcode, t.formula as formula, t.duebalance as winloss, t.rate as currate, '-' as account,t.description as description FROM placeout t, currency c, url u, project p where t.project_id=p.id and t.curr_id=c.id and t.url_id = u.id and t.sh_id='$id' and t.hidden ='0' and t.curr_id='$curr' $filter_sql
					UNION 
				SELECT t.date as date, t.project_id as project_id, p.name as project_name, '-' as url_id, '-' as url, t.sh_id as sh_id, t.ag_id as ag_id, '-' as meb_id, '-' as amount, t.curr_id as curr_id, c.code as curcode, '-' as formula, t.amount as winloss, t.curr_rate_1 as currate, t.payer_2 as account,t.remark as description FROM transaction t, currency c, account a, project p where t.project_id=p.id and t.curr_id=c.id and t.sh_id='$id' and t.hidden ='0'  and t.curr_id='$curr' $filter_sql";
		}
		else
		{
			$sql="SELECT t.date as date, t.project_id as project_id, p.name as project_name, t.url_id as url_id, u.url as url, t.sh_id as sh_id, t.ag_id as ag_id, t.meb_id as meb_id, t.amount as amount, t.curr_id as curr_id, c.code as curcode, t.formula as formula, t.duebalance as winloss, t.rate as currate, '-' as account,t.description as description FROM placeout t, currency c, url u, project p where t.project_id=p.id and t.curr_id=c.id and t.url_id = u.id and t.ag_id='$id' and t.hidden ='0'  and t.curr_id='$curr' $filter_sql
					UNION 
				SELECT t.date as date, t.project_id as project_id, p.name as project_name, '-' as url_id, '-' as url, t.sh_id as sh_id, t.ag_id as ag_id, '-' as meb_id, '-' as amount, t.curr_id as curr_id, c.code as curcode, '-' as formula, t.amount as winloss, t.curr_rate_1 as currate, t.payer_2 as account,t.remark as description FROM transaction t, currency c, account a, project p where t.project_id=p.id and t.curr_id=c.id and t.ag_id='$id' and t.hidden ='0'  and t.curr_id='$curr' $filter_sql";
		}

		$query=$this->db->query($sql);
		return $query->result();
	}
}


/* End of file Report_model.php */
/* Location: ./application/model/Report_model.php */