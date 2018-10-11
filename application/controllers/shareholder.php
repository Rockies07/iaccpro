<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shareholder extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('shareholder_model','shareholder_model',TRUE);
		$this->load->model('project_model','project_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$filter_status=$this->input->post('filter_status');
		$data=array(
				'action' => site_url('shareholder/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'shareholder'=>$this->shareholder_model->get_data_list($filter_status),
				'project'=>$this->project_model->get_data_list('1'),
				'shareholder_model'=>$this->shareholder_model,
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('shareholder/index',$data);
		$this->load->view('template/footer');
	}

	function save_shareholder()
	{
		$id=$this->input->post('id');
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
				$shareholder=array(
					'code'=>$code,
					'password'=>$password,
					'status'=>$status,
					'name'=>$name,
					'contact'=>$contact,
					'bank_acc_info'=>$bank_acc_info,
					'remark'=>$remark,
					'placeout'=>$placeout,
					'report'=>$report,
					'journal'=>$journal,
					'transaction'=>$transaction,
					'management'=>$management,
					'ipaddress'=>$this->input->ip_address(),
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_username()
				);
			}
			else
			{
				$shareholder=array(
					'code'=>$code,
					'status'=>$status,
					'name'=>$name,
					'contact'=>$contact,
					'bank_acc_info'=>$bank_acc_info,
					'remark'=>$remark,
					'placeout'=>$placeout,
					'report'=>$report,
					'journal'=>$journal,
					'transaction'=>$transaction,
					'management'=>$management,
					'ipaddress'=>$this->input->ip_address(),
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_username()
				);
			}

			$this->shareholder_model->update($id,$shareholder);
			$insert_id=$id;
		}
		else
		{
			$shareholder=array(
				'code'=>$code,
				'password'=>$password,
				'status'=>$status,
				'name'=>$name,
				'contact'=>$contact,
				'bank_acc_info'=>$bank_acc_info,
				'remark'=>$remark,
				'placeout'=>$placeout,
				'report'=>$report,
				'journal'=>$journal,
				'transaction'=>$transaction,
				'management'=>$management,
				'ipaddress'=>$this->input->ip_address(),
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_username(),
				'createdate'=>date('Y-m-d H:i:s',now()),
				'createby'=>$this->access->get_username()
			);
			$insert_id=$this->shareholder_model->insert($shareholder);
		}
		
		echo $insert_id;
		exit();
	}

	function save_menu_shareholder()
	{
		$id=$this->input->post('id');
		$placeout=$this->input->post('placeout');
		$management=$this->input->post('management');
		$journal=$this->input->post('journal');
		$report=$this->input->post('report');
		$transaction=$this->input->post('transaction');

		$shareholder=array(
			'placeout'=>$placeout,
			'report'=>$report,
			'journal'=>$journal,
			'transaction'=>$transaction,
			'management'=>$management,
			'updatedate'=>date('Y-m-d H:i:s',now()),
			'updateby'=>$this->access->get_user()
		);	

		$this->shareholder_model->update($id,$shareholder);
		$insert_id=$id;
		
		echo $insert_id;
		exit();
	}

	function delete_project_shareholder()
	{
		$id=$this->input->post('id');
		$value=$this->input->post('value');	

		$this->shareholder_model->delete_shareholder_project($id,$value);
		
		echo 'success';
		exit();
	}

	function save_shareholder_project()
	{
		$sh_id=$this->input->post('id');
		$project_id=$this->input->post('value');

		$shareholder=array(
			'sh_id'=>$sh_id,
			'project_id'=>$project_id
		);
		$insert_id=$this->shareholder_model->insert_project($shareholder);
		
		echo $insert_id;
		exit();
	}
	
	function get_shareholder_detail()
	{
		$id=$this->input->post('id');

		$shareholder = $this->shareholder_model->get_by_id($id);
		
		echo json_encode($shareholder);
		exit();
	}

	function get_shareholder_project_detail()
	{	
		$id=$this->input->post('id');

		$shareholder = $this->shareholder_model->get_project_by_id($id);
		
		echo json_encode($shareholder);
		exit();
	}

	function delete_shareholder_project()
	{
		$id=$this->input->post('id');

		$shareholder = $this->shareholder_model->delete_shareholder_project($id);
		
		echo "success";
		exit();
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('name','Shareholder','required');
	}
	
	function delete($id,$page)
	{
		//delete shareholder
		$this->shareholder_model->delete($id);
		redirect('shareholder/'.$page);
	}

	function get_counter()
	{
		$id=$this->input->post('code');

		$counter = $this->shareholder_model->is_exist('code',$id);

		echo $counter;
	}
}

/* End of file shareholder.php */
/* Location: ./application/controllers/shareholder.php */