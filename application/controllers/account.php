<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('account_model','account_model',TRUE);
		$this->load->model('currency_model','currency_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$filter_status=$this->input->post('filter_status');
		$data=array(
				'action' => site_url('account/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'account'=>$this->account_model->get_data_list($filter_status),
				'currency'=>$this->currency_model->get_data_list(),
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('account/index',$data);
		$this->load->view('template/footer');
	}

	function save_account()
	{
		$id=$this->input->post('id');
		$currency_id=$this->input->post('currency_id');
		$mode=$this->input->post('mode');
		$number=$this->input->post('number');
		$profile=$this->input->post('profile');
		$security=$this->input->post('security');
		$contact=$this->input->post('contact');
		$email=$this->input->post('email');
		$remark=$this->input->post('remark');
		$status=$this->input->post('status');

		if($id>0)
		{
			$account=array(
				'currency_id'=>$currency_id,
				'mode'=>$mode,
				'number'=>$number,
				'profile'=>$profile,
				'security'=>$security,
				'contact'=>$contact,
				'email'=>$email,
				'remark'=>$remark,
				'status'=>$status,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user()
			);

			$this->account_model->update($id,$account);
		}
		else
		{
			$account=array(
				'currency_id'=>$currency_id,
				'mode'=>$mode,
				'number'=>$number,
				'profile'=>$profile,
				'security'=>$security,
				'contact'=>$contact,
				'email'=>$email,
				'remark'=>$remark,
				'status'=>$status,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user(),
				'createdate'=>date('Y-m-d H:i:s',now()),
				'createby'=>$this->access->get_user()
			);
			$insert_id=$this->account_model->insert($account);
		}
		
		echo $insert_id;
	}
	
	function get_account_detail()
	{
		$id=$this->input->post('id');

		$account = $this->account_model->get_by_id($id);
		
		echo json_encode($account);
		exit();
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('number','Account','required');
	}
	
	function delete($id,$page)
	{
		//delete account
		$this->account_model->delete($id);
		redirect('account/'.$page);
	}
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */