<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('shareholder_model','shareholder_model',TRUE);
		$this->load->model('agent_model','agent_model',TRUE);
		$this->load->model('member_model','member_model',TRUE);
		$this->load->model('project_model','project_model',TRUE);
		$this->load->model('currency_model','currency_model',TRUE);
		$this->load->model('url_model','url_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$filter_status=$this->input->post('filter_status');
		$data=array(
				'action' => site_url('member/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'member'=>$this->member_model->get_data_list($filter_status),
				'shareholder'=>$this->shareholder_model->get_data_list(1),
				'agent'=>$this->agent_model->get_data_list(1),
				'project'=>$this->project_model->get_data_list(1),
				'url'=>$this->url_model->get_data_list('1'),
				'currency'=>$this->currency_model->get_data_list(),
				'member_model'=>$this->member_model,
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('member/index',$data);
		$this->load->view('template/footer');
	}

	function save_member()
	{
		$id=$this->input->post('id');
		$upline_id=$this->input->post('upline_id');
		$upline_arr=explode("-", $upline_id);
		if($upline_arr[0] == "sh")
		{
			$sh_id=$upline_arr[1];
			$ag_id="";
		}
		else
		{
			$ag_id=$upline_arr[1];
			$sh_id=$this->agent_model->get_by_code($ag_id)->sh_id;
		}
		$code=$this->input->post('code');
		$password=$this->input->post('password');
		$url=$this->input->post('url');
		$status=$this->input->post('status');
		$remark=$this->input->post('remark');
		$curr=$this->input->post('curr');
		$ppt=$this->input->post('ppt');
		$formula=$this->input->post('formula');
		$project=$this->input->post('project');
		if($code!="" && $password!="")
		{
			if($password!="")
			{
				$member=array(
					'project_id'=>$project,
					'sh_id'=>$sh_id,
					'ag_id'=>$ag_id,
					'code'=>$code,
					'password'=>$password,
					'url_id'=>$url,
					'status'=>$status,
					'remark'=>$remark,
					'currency_id'=>$curr,
					'ppt'=>$ppt,
					'ppt_formula'=>$formula,
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_username()
				);
			}
			else
			{
				$member=array(
					'project_id'=>$project,
					'sh_id'=>$sh_id,
					'ag_id'=>$ag_id,
					'code'=>$code,
					'url_id'=>$url,
					'status'=>$status,
					'remark'=>$remark,
					'currency_id'=>$curr,
					'ppt'=>$ppt,
					'ppt_formula'=>$formula,
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_username()
				);
			}
			
			$this->member_model->update($id,$member);
			$insert_id=$id;
		//	print_r($member);
		}
		
		echo $insert_id;
	}

	function add()
	{
		$data=array(
				'action' => site_url('member/add'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'shareholder'=>$this->shareholder_model->get_data_list(1),
				'agent'=>$this->agent_model->get_data_list(1),
				'project'=>$this->project_model->get_data_list(1),
				'url'=>$this->url_model->get_data_list('1'),
				'currency'=>$this->currency_model->get_data_list(),
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Member"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('member/add',$data);
		$this->load->view('template/footer');
		
		echo $insert_id;
	}

	function save_member_multiple()
	{
		$project = $this->input->post('project');
		for($i=1; $i<=20; $i++)
		{
			$upline_id=$this->input->post('upline_'.$i);
			$upline_arr=explode("-", $upline_id);
			if($upline_arr[0] == "sh")
			{
				$sh_id=$upline_arr[1];
				$ag_id="";
			}
			else
			{
				$ag_id=$upline_arr[1];
				$sh_id=$this->agent_model->get_by_code($ag_id)->sh_id;
			}
			$code=$this->input->post('code_'.$i);
			$password=$this->input->post('password_'.$i);
			$url=$this->input->post('url_'.$i);
			$status=$this->input->post('status_'.$i);
			$remark=$this->input->post('remark_'.$i);
			$curr=$this->input->post('curr_'.$i);
			$ppt=$this->input->post('ppt_'.$i);
			$formula=$this->input->post('formula_'.$i);

			if($code!="" && $password!="")
			{
				$member=array(
					'project_id'=>$project,
					'sh_id'=>$sh_id,
					'ag_id'=>$ag_id,
					'code'=>$code,
					'password'=>$password,
					'url_id'=>$url,
					'status'=>$status,
					'remark'=>$remark,
					'currency_id'=>$curr,
					'ppt'=>$ppt,
					'ppt_formula'=>$formula,
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_username(),
					'createdate'=>date('Y-m-d H:i:s',now()),
					'createby'=>$this->access->get_username()
				);
				
				$insert_id = $this->member_model->insert($member);
			//	print_r($member);
			}
		}
		
		echo $insert_id;
	}
	
	function get_member_detail()
	{
		$id=$this->input->post('id');

		$member = $this->member_model->get_by_id($id);
		
		echo json_encode($member);
		exit();
	}

	function get_data_list()
	{
		$project=$this->input->post('project');

		$member = $this->member_model->get_data_list('1',$project);
		
		echo json_encode($member);
		exit();
	}

	function get_counter()
	{
		$id=$this->input->post('code');

		$counter = $this->member_model->is_exist('code',$id);

		echo $counter;
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('name','member','required');
	}
	
	function delete($id,$page)
	{
		//delete member
		$this->member_model->delete($id);
		redirect('member/'.$page);
	}
}

/* End of file member.php */
/* Location: ./application/controllers/member.php */