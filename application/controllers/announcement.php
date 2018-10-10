<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcement extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('announcement_model','announcement_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$data['announcement']=$this->announcement_model->get_data_list($category);
		$data['title']="iAccpro";
		$data['site_name']="iAccpro";	
		$data['quote']="Maintain Your Account";
		$data['category']=$category;
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('announcement/index',$data);
		$this->load->view('template/footer');
	}
	
	function _set_rules()
	{
		$this->form_validation->set_rules('title','Announcement Title','required');
		$this->form_validation->set_rules('description','Description','trim');
		$this->form_validation->set_rules('categories','Categories','trim');
	}
	
	function management($id=0)
	{
		$data['action']=site_url('announcement/management/'.$id);
		$data['attribute']=array('class' => 'form-horizontal form-bordered');
		$data['link_back']=anchor('announcement/management/'.$id, 'Back', array('class'=>'back'));
		
		$data['notification']="";
		$data['edit_id']=$id;
		
		$data['edit_announcement']=$this->announcement_model->get_by_id($id);
		
		$edit_id=$this->input->post('edit_id');
		
		if($edit_id>"0")
		{
			//if update from existing data
			$announcement=array(
					'title'=>$this->input->post('title'),
					'description'=>$this->input->post('description'),
					'category'=>$this->input->post('category')
			);
				
			$this->announcement_model->update($edit_id,$announcement);
			//$this->output->enable_profiler(1);
			redirect('announcement/index');
		}
		else 
		{
			//set common properties
			//$this->output->enable_profiler(1);
			$this->_set_rules();
				
			if($this->form_validation->run() === FALSE)
			{
				$data['announcement']=$this->announcement_model->get_data_list('all');
				$data['title']="IAccpro";
				$data['site_name']="IAccpro";	
				$data['quote']="Maintain Your Account";
				$this->load->view('template/header',$data);
				$this->load->view('template/sidelink');
				$this->load->view('announcement/management',$data);
				$this->load->view('template/footer');
			}
			else
			{
				//save data
				$announcement=array(
						'title'=>$this->input->post('title'),
						'description'=>$this->input->post('description'),
						'category'=>$this->input->post('category'),
						'createdate'=>date('Y-m-d H:i:s',now()),
						'createby'=>$this->access->get_username()
				);
					
				$id=$this->announcement_model->insert($announcement);
					
				//set form input nama ="id"
				$this->validation->id=$id;
					
				redirect('announcement/index');
			}
		}
	}
	
	function delete($id,$page)
	{
		//delete announcement
		$this->announcement_model->delete($id);
		redirect('announcement/'.$page);
	}
}

/* End of file announcement.php */
/* Location: ./application/controllers/announcement.php */