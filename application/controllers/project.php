<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('project_model','project_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$filter_status=$this->input->post('filter_status');
		$data=array(
				'action' => site_url('project/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'project'=>$this->project_model->get_data_list($filter_status),
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('project/index',$data);
		$this->load->view('template/footer');
	}

	function save_project()
	{
		$id=$this->input->post('id');
		$mode=$this->input->post('mode');
		$type=$this->input->post('type');
		$name=$this->input->post('name');
		$remark=$this->input->post('remark');
		$address=$this->input->post('address');
		$email=$this->input->post('email');
		$status=$this->input->post('status');

		if($id>0)
		{
			$project=array(
				'id'=>$id,
				'mode'=>$mode,
				'type'=>$type,
				'name'=>$name,
				'remark'=>$remark,
				'address'=>$address,
				'email'=>$email,
				'status'=>$status,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user()
			);

			$this->project_model->update($id,$project);
		}
		else
		{
			$project=array(
				'mode'=>$mode,
				'type'=>$type,
				'name'=>$name,
				'remark'=>$remark,
				'address'=>$address,
				'email'=>$email,
				'status'=>$status,
				'createdate'=>date('Y-m-d H:i:s',now()),
				'createby'=>$this->access->get_user()
			);
			$insert_id=$this->project_model->insert($project);
		}
		
		echo $insert_id;
		exit();
	}
	
	function get_project_detail()
	{
		$id=$this->input->post('id');

		$project = $this->project_model->get_by_id($id);
		
		echo json_encode($project);
		exit();
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('name','Project','required');
	}
	
	function delete($id,$page)
	{
		//delete project
		$this->project_model->delete($id);
		redirect('project/'.$page);
	}
}

/* End of file project.php */
/* Location: ./application/controllers/project.php */