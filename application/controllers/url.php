<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('url_model','url_model',TRUE);
		$this->load->model('project_model','project_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$filter_status=$this->input->post('filter_status');
		$data=array(
				'action' => site_url('url/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'url'=>$this->url_model->get_data_list($filter_status),
				'project'=>$this->project_model->get_data_list('1'),
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('url/index',$data);
		$this->load->view('template/footer');
	}

	function save_url()
	{
		$id=$this->input->post('id');
		$project_id=$this->input->post('project_id');
		$url=$this->input->post('url');
		$status=$this->input->post('status');

		if($id>0)
		{
			$url=array(
				'project_id'=>$project_id,
				'url'=>$url,
				'status'=>$status,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user()
			);

			$this->url_model->update($id,$url);
		}
		else
		{
			$url=array(
				'project_id'=>$project_id,
				'url'=>$url,
				'status'=>$status,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user(),
				'createdate'=>date('Y-m-d H:i:s',now()),
				'createby'=>$this->access->get_user()
			);
			$insert_id=$this->url_model->insert($url);
		}
		
		echo $insert_id;
		exit();
	}
	
	function get_url_detail()
	{
		$id=$this->input->post('id');

		$url = $this->url_model->get_by_id($id);
		
		echo json_encode($url);
		exit();
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('name','Url','required');
	}
	
	function delete($id,$page)
	{
		//delete url
		$this->url_model->delete($id);
		redirect('url/'.$page);
	}
}

/* End of file url.php */
/* Location: ./application/controllers/url.php */