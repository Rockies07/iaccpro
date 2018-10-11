<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Placeout extends User_Access_Controller 
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
		$this->load->model('placeout_model','placeout_model',TRUE);
		$this->load->model('project_model','project_model',TRUE);
		$this->load->model('currency_model','currency_model',TRUE);
		$this->load->model('url_model','url_model',TRUE);
	}
	 
	function index($category=0)
	{
		// Render the template
		$filter_status=$this->input->post('filter_status');
		$data=array(
				'action' => site_url('placeout/index'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'shareholder'=>$this->shareholder_model->get_data_list(1),
				'agent'=>$this->agent_model->get_data_list(1),
				'member'=>$this->member_model->get_data_list(1),
				'project'=>$this->project_model->get_data_list(1,'SB'),
				'url'=>$this->url_model->get_data_list('1'),
				'currency'=>$this->currency_model->get_data_list(),
				'placeout_model'=>$this->placeout_model,
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('placeout/index',$data);
		$this->load->view('template/footer');
	}

	function add()
	{
		$data=array(
				'action' => site_url('placeout/add'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'shareholder'=>$this->shareholder_model->get_data_list(1),
				'agent'=>$this->agent_model->get_data_list(1),
				'project'=>$this->project_model->get_data_list(1),
				'url'=>$this->url_model->get_data_list('1'),
				'currency'=>$this->currency_model->get_data_list(),
				'filter_status'=>$filter_status,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Placeout"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('placeout/add',$data);
		$this->load->view('template/footer');
		
		echo $insert_id;
		exit();
	}

	function save_placeout()
	{
		$project = $this->input->post('project');
		$date = $this->input->post('date');
		for($i=1; $i<=20; $i++)
		{
			$id=$this->input->post('id_'.$i);
			$amount=$this->input->post('amount_'.$i);
			$description=$this->input->post('description_'.$i);
			$get_member_detail=$this->member_model->get_by_id($id);
			$sh_id=$get_member_detail->sh_id;
			$ag_id=$get_member_detail->ag_id;
			$code=$get_member_detail->code;
			$curr_id=$get_member_detail->curr;
			$remark=$get_member_detail->remark;
			$ppt=$get_member_detail->ppt;
			$formula=$get_member_detail->formula;
			$url_id=$get_member_detail->url_id;

			$str_formula="($amount*-1)*$ppt/100$formula";
			eval( '$result = (' . $str_formula. ');' );
			$cpybalance=$result;

			$str_formula="($amount)*$ppt/100$formula";
			eval( '$result = (' . $str_formula. ');' );
			$duebalance=$result;

			if($id!="" && $amount!="")
			{
				$placeout=array(
					'project_id'=>$project,
					'date'=>date('Y-m-d',strtotime($date)),
					'sh_id'=>$sh_id,
					'ag_id'=>$ag_id,
					'meb_id'=>$code,
					'url_id'=>$url_id,
					'amount'=>$amount,
					'curr_id'=>$curr_id,
					'description'=>$description,
					'remark'=>$remark,
					'ppt'=>$ppt,
					'formula'=>$formula,
					'cpybalance'=>$cpybalance,
					'duebalance'=>$duebalance,
					'updatedate'=>date('Y-m-d H:i:s',now()),
					'updateby'=>$this->access->get_username(),
					'createdate'=>date('Y-m-d H:i:s',now()),
					'createby'=>$this->access->get_username()
				);
				
				$insert_id = $this->placeout_model->insert($placeout);
				print_r($insert_id);
			}
		}
		
		echo $insert_id;
		exit();
	}
	
	function get_placeout_detail()
	{
		$id=$this->input->post('id');

		$placeout = $this->placeout_model->get_by_id($id);
		
		echo json_encode($placeout);
		exit();
	}

	function get_counter()
	{
		$id=$this->input->post('code');

		$counter = $this->placeout_model->is_exist('code',$id);

		echo $counter;
		exit();
	}

	function _set_rules()
	{
		$this->form_validation->set_rules('name','placeout','required');
	}
	
	function delete($id,$page)
	{
		//delete placeout
		$this->placeout_model->delete($id);
		redirect('placeout/'.$page);
	}
}

/* End of file placeout.php */
/* Location: ./application/controllers/placeout.php */