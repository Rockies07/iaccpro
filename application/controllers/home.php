<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends User_Access_Controller 
{
	private $limit=30;
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('form');
		$this->load->model('company_model');
		$this->load->model('business_model');
		$this->load->model('employee_model');
	}
	 
	function index()
	{	
		$data['no_of_man']=$this->employee_model->get_employee_count_by_date(date('m/d/Y'));
		$data['no_of_man_spass']=$this->employee_model->get_employee_count_by_date(date('m/d/Y'),'Spass');
		$data['no_of_man_mye']=$this->employee_model->get_employee_count_by_date(date('m/d/Y'),'MYE');
		$data['no_of_man_tier_1']=$this->employee_model->get_employee_count_by_date(date('m/d/Y'),'Skilled');
		$data['no_of_man_tier_2']=$this->employee_model->get_employee_count_by_date(date('m/d/Y'),'Unskilled' );
		$data['no_of_man_ctms']=$this->employee_model->get_employee_count_by_exp(date('m/d/Y'),4,1);
		$data['no_of_man_ms2']=$this->employee_model->get_employee_count_by_exp(date('m/d/Y'),6,1,50,120);
		$data['wp_exp_list']=$this->employee_model->get_employee_by_exp_list('wp',date('m'),date('Y'));
		if(date('m')=='12')
		{
			$data['wp_exp_list_next']=$this->employee_model->get_employee_by_exp_list('wp','01',date('Y')+1);
		}
		else
		{
			$data['wp_exp_list_next']=$this->employee_model->get_employee_by_exp_list('wp',date('m')+1,date('Y'));
		}

		$data['no_of_man_std']=$this->employee_model->get_data_list_by_date(date('m/d/Y'),'Storeman','count');
		$data['no_of_man_spvsf']=$this->employee_model->get_data_list_by_date(date('m/d/Y'),'Supervisor','count');
		$data['no_of_man_e']=$this->employee_model->get_data_list_by_date(date('m/d/Y'),'Erector','count');
		$data['no_of_man_gw']=$this->employee_model->get_data_list_by_date(date('m/d/Y'),'General Worker','count');

		$data['csoc_exp_list']=$this->employee_model->get_employee_by_exp_list('csoc',date('m'),date('Y'));
		if(date('m')=='12')
		{
			$data['csoc_exp_list_next']=$this->employee_model->get_employee_by_exp_list('csoc','01',date('Y')+1);
		}
		else
		{
			$data['csoc_exp_list_next']=$this->employee_model->get_employee_by_exp_list('csoc',date('m')+1,date('Y'));
		}

		$data['no_of_man_ap']=$this->employee_model->get_airport_pass_list(date('m/d/Y'));
		$data['no_of_man_ap_i']=$this->employee_model->get_airport_pass_list(date('m/d/Y'),'indian');
		$data['no_of_man_ap_b']=$this->employee_model->get_airport_pass_list(date('m/d/Y'),'bangladeshi');

		$data['title']=$this->access->get_site_name();
		$data['site_name']=$this->access->get_sys_name();	
		$data['quote']=$this->access->get_sys_motto();
		$this->load->view('template/header',$data);
		$this->load->view('template/sidelink');
		$this->load->view('home/index',$data);
		$this->load->view('template/footer');
	}
}

/* End of file announcement.php */
/* Location: ./application/controllers/announcement.php */