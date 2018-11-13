<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends User_Access_Controller 
{
	private $limit=30;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','utility'));
		$this->load->helper('form');
		$this->load->model('shareholder_model','shareholder_model',TRUE);
		$this->load->model('agent_model','agent_model',TRUE);
		$this->load->model('member_model','member_model',TRUE);
		$this->load->model('report_model','report_model',TRUE);
		$this->load->model('project_model','project_model',TRUE);
		$this->load->model('currency_model','currency_model',TRUE);
		$this->load->model('url_model','url_model',TRUE);
	}
	 
	function win_loss()
	{

		// Render the template
		$filter_upline=$this->input->post('filter_upline');
		$filter_from=$this->input->post('filter_from');
		$filter_to=$this->input->post('filter_to');
		$filter_project=$this->input->post('filter_project');
		$filter_project_text=$this->project_model->get_by_id($filter_project)->name;

		if($filter_from == "")
		{
			$filter_from = date('01-m-Y');
		}

		if($filter_to == "")
		{
			$filter_to = date('t-m-Y');
		}

		$data=array(
				'action' => site_url('report/win_loss'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'transaction'=>$this->report_model->win_loss($filter_from,$filter_to,$filter_project,$filter_upline),
				'report_model'=>$this->report_model,
				'project'=>$this->project_model->get_data_list('1','SB'),
				'shareholder'=>$this->shareholder_model->get_data_list('1'),
				'agent'=>$this->agent_model->get_data_list('1'),
				'member'=>$this->member_model->get_data_list('1'),
				'currency'=>$this->currency_model->get_data_list('1'),
				'utility'=>$this->utility,
				'filter_from'=>$filter_from,
				'filter_to'=>$filter_to,
				'filter_project'=>$filter_project,
				'filter_project_text'=>$filter_project_text,
				'filter_upline'=>$filter_upline,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('report/win_loss',$data);
		$this->load->view('template/footer');
	}

	function due_balance()
	{
		// Render the template
		$data=array(
				'action' => site_url('report/due_balance'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'shareholder'=>$this->shareholder_model->get_data_list('1'),
				'agent'=>$this->agent_model->get_data_list('1'),
				'report_model'=>$this->report_model,
				'utility'=>$this->utility,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('report/due_balance',$data);
		$this->load->view('template/footer');
	}

	function balance_detail($level,$id,$curr_id)
	{
		// Render the template
		$filter_from=$this->input->post('filter_from');
		$filter_to=$this->input->post('filter_to');
		$filter_project=$this->input->post('filter_project');
		$filter_project_text=$this->project_model->get_by_id($filter_project)->name;
		$filter_id=$this->input->post('filter_id');
		$filter_curr=$this->input->post('filter_curr');
		$filter_level=$this->input->post('filter_level');

		if($filter_from == "")
		{
			$filter_from = date('01-m-Y');
		}

		if($filter_to == "")
		{
			$filter_to = date('t-m-Y');
		}

		if($level=='sh')
		{
			$id=$this->shareholder_model->get_by_id($id)->code;
		}
		else
		{
			$id=$this->agent_model->get_by_id($id)->code;
		}

		if($filter_id=="")
		{
			$filter_id=$id;
		}

		if($filter_curr=="")
		{
			$filter_curr=$curr_id;
		}

		if($filter_level=="")
		{
			$filter_level=$level;
		}

		$data=array(
				'action' => site_url('report/balance_detail'),
				'attribute' => array('class' => 'form-horizontal', 'id' => 'myForm'),
				'transaction'=>$this->report_model->get_balance_detail($filter_id, $filter_curr,$filter_level,$filter_from,$filter_to,$filter_project),
				'report_model'=>$this->report_model,
				'project'=>$this->project_model->get_data_list('1','SB'),
				'shareholder'=>$this->shareholder_model->get_data_list('1'),
				'agent'=>$this->agent_model->get_data_list('1'),
				'member'=>$this->member_model->get_data_list('1'),
				'currency'=>$this->currency_model->get_data_list('1'),
				'utility'=>$this->utility,
				'filter_from'=>$filter_from,
				'filter_to'=>$filter_to,
				'filter_project'=>$filter_project,
				'filter_project_text'=>$filter_project_text,
				'filter_id'=>$filter_id,
				'filter_curr'=>$filter_curr,
				'filter_level'=>$filter_level,
				'title'=>"iAccpro",
				'site_name'=>"iAccpro",
				'quote'=>"Maintain Your Account"
			);
		
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('report/balance_detail',$data);
		$this->load->view('template/footer');
	}

	function delete()
	{
		//delete project
		$id=$this->input->post('id');
		$this->report_model->delete($id);/*
		redirect('report/'.$page, 'refresh');*/
		echo 'success';
		exit();
	}
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */