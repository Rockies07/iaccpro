<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('currency_model','currency_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$data=array(
				'action' => site_url('currency/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'currency'=>$this->currency_model->get_data_list(),
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('currency/index',$data);
		$this->load->view('template/footer');
	}

	function save_currency()
	{
		$id=$this->input->post('id');
		$code=$this->input->post('code');
		$rate=$this->input->post('rate');
		$name=$this->input->post('name');

		if($id>0)
		{
			$currency=array(
				'code'=>$code,
				'rate'=>$rate,
				'name'=>$name,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user()
			);

			$this->currency_model->update($id,$currency);
		}
		else
		{
			$currency=array(
				'code'=>$code,
				'rate'=>$rate,
				'name'=>$name,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user(),
				'createdate'=>date('Y-m-d H:i:s',now()),
				'createby'=>$this->access->get_user()
			);
			$insert_id=$this->currency_model->insert($currency);
		}
		
		echo $insert_id;
		exit();
	}
	
	function get_currency_detail()
	{
		$id=$this->input->post('id');

		$currency = $this->currency_model->get_by_id($id);
		
		echo json_encode($currency);
		exit();
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('name','Currency','required');
	}
	
	function delete($id,$page)
	{
		//delete currency
		$this->currency_model->delete($id);
		redirect('currency/'.$page);
	}
}

/* End of file currency.php */
/* Location: ./application/controllers/currency.php */