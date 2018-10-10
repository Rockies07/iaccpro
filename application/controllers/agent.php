<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('shareholder_model','shareholder_model',TRUE);
		$this->load->model('agent_model','agent_model',TRUE);
		$this->load->model('project_model','project_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$filter_status=$this->input->post('filter_status');
		$data=array(
				'action' => site_url('agent/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'agent'=>$this->agent_model->get_data_list($filter_status),
				'project'=>$this->project_model->get_data_list('1'),
				'shareholder'=>$this->shareholder_model->get_data_list(1),
				'agent_model'=>$this->agent_model,
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('agent/index',$data);
		$this->load->view('template/footer');
	}

	function save_agent()
	{
		$id=$this->input->post('id');
		$sh_id=$this->input->post('sh_id');
		$code=$this->input->post('code');
		$password=$this->input->post('password');
		$status=$this->input->post('status');
		$name=$this->input->post('name');
		$contact=$this->input->post('contact');
		$bank_acc_info=$this->input->post('bank_acc_info');
		$remark=$this->input->post('remark');
		$placeout=$this->input->post('placeout');
		$management=$this->input->post('management');
		$journal=$this->input->post('journal');
		$report=$this->input->post('report');
		$transaction=$this->input->post('transaction');

		if($id>0)
		{
			if($password!="")
			{
				$agent=array(
					'sh_id'=>$sh_id,
					'code'=>$code,
					'password'=>$password,
					'status'=>$status,
					'name'=>$name,
					'contact'=>$contact,
					'bank_acc_info'=>$bank_acc_info,
					'remark'=>$remark,
					'ipaddress'=>$this->input->ip_address(),
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_username()
				);
			}
			else
			{
				$agent=array(
					'sh_id'=>$sh_id,
					'status'=>$status,
					'name'=>$name,
					'contact'=>$contact,
					'bank_acc_info'=>$bank_acc_info,
					'remark'=>$remark,
					'ipaddress'=>$this->input->ip_address(),
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_username()
				);
			}

			$this->agent_model->update($id,$agent);
			$insert_id=$id;
		}
		else
		{
			$agent=array(
				'sh_id'=>$sh_id,
				'code'=>$code,
				'password'=>$password,
				'status'=>$status,
				'name'=>$name,
				'contact'=>$contact,
				'bank_acc_info'=>$bank_acc_info,
				'remark'=>$remark,
				'ipaddress'=>$this->input->ip_address(),
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_username(),
				'createdate'=>date('Y-m-d H:i:s',now()),
				'createby'=>$this->access->get_username()
			);
			$insert_id=$this->agent_model->insert($agent);
		}
		
		echo $insert_id;
	}
	
	function get_agent_detail()
	{
		$id=$this->input->post('id');

		$agent = $this->agent_model->get_by_id($id);
		
		echo json_encode($agent);
		exit();
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('name','agent','required');
	}
	
	function delete($id,$page)
	{
		//delete agent
		$this->agent_model->delete($id);
		redirect('agent/'.$page);
	}

	function get_counter()
	{
		$id=$this->input->post('code');

		$counter = $this->agent_model->is_exist('code',$id);

		echo $counter;
	}
}

/* End of file agent.php */
/* Location: ./application/controllers/agent.php */