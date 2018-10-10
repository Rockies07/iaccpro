<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ledger extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('ledger_model','ledger_model',TRUE);
		$this->load->model('currency_model','currency_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$filter_status=$this->input->post('filter_status');
		$data=array(
				'action' => site_url('ledger/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'ledger'=>$this->ledger_model->get_data_list($filter_status),
				'currency'=>$this->currency_model->get_data_list(),
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Ledger"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('ledger/index',$data);
		$this->load->view('template/footer');
	}

	function save_ledger()
	{
		$id=$this->input->post('id');
		$code=$this->input->post('code');
		$header=$this->input->post('header');
		$parent=$this->input->post('parent');
		$ledger=$this->input->post('ledger');
		$report=$this->input->post('report');
		$type=$this->input->post('type');

		if($id>0)
		{
			$ledger=array(
				'code'=>$code,
				'header'=>$header,
				'parent'=>$parent,
				'name'=>$ledger,
				'type'=>$type,
				'report'=>$report,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user()
			);

			$this->ledger_model->update($id,$ledger);
		}
		else
		{
			$ledger=array(
				'code'=>$code,
				'header'=>$header,
				'parent'=>$parent,
				'name'=>$ledger,
				'type'=>$type,
				'report'=>$report,
				'updatedate'=>date('Y-m-d H:i:s',now()),
				'updateby'=>$this->access->get_user(),
				'createdate'=>date('Y-m-d H:i:s',now()),
				'createby'=>$this->access->get_user()
			);
			$insert_id=$this->ledger_model->insert($ledger);
		}
		
		echo $insert_id;
	}

	function save_ledger_multiple()
	{
		for($i=1; $i<=20; $i++)
		{
			$code=$this->input->post('code_'.$i);
			$header=$this->input->post('header_'.$i);
			$parent=$this->input->post('parent_'.$i);
			$ledger=$this->input->post('ledger_'.$i);
			$type=$this->input->post('type_'.$i);
			$report=$this->input->post('report_'.$i);

			if($code!="" && $type!="" && $ledger!="" && $report!="")
			{
				$ledger=array(
					'code'=>$code,
					'header'=>$header,
					'parent'=>$parent,
					'name'=>$ledger,
					'type'=>$type,
					'report'=>$report,
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_user(),
					'createdate'=>date('Y-m-d H:i:s',now()),
					'createby'=>$this->access->get_user()
				);
				
				$insert_id = $this->ledger_model->insert($ledger);
			}
		}
		
		echo $insert_id;
	}

	function add()
	{
		$data=array(
				'action' => site_url('ledger/add'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'ledger'=>$this->ledger_model->get_data_list(),
				'currency'=>$this->currency_model->get_data_list(),
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Ledger"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('ledger/add',$data);
		$this->load->view('template/footer');
		
		echo $insert_id;
	}
	
	function get_ledger_detail()
	{
		$id=$this->input->post('id');

		$ledger = $this->ledger_model->get_by_id($id);
		
		echo json_encode($ledger);
		exit();
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('number','Ledger','required');
	}
	
	function delete($id,$page)
	{
		//delete ledger
		$this->ledger_model->delete($id);
		redirect('ledger/'.$page);
	}
}

/* End of file ledger.php */
/* Location: ./application/controllers/ledger.php */