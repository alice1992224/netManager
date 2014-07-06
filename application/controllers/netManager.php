<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NetManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('manager_model');
		$this->load->library('table');
	}


	public function index()
	{
		$data['ip'] = $this->input->ip_address();
        $query = $this->db->get('user');
        $valid_ip = FALSE; 
        foreach ($query->result() as $row){
            if($data['ip'] == $row->ip){
                $valid_ip = TRUE;
            }
        }
        if($valid_ip){
		    $data['online'] = $this->manager_model->check_status();	
		    $data['remain_time'] = $this->manager_model->count_remain();	
		    /**if($data['remain_time'] <= 0){
			    $data['online'] = FALSE;
			    $this->manager_model->change_status($data['ip']);
		    }*/

		    $this->load->view('templates/header');
		    $this->load->view('portal', $data);
        }
        else{
		    $this->load->view('templates/header');
            $this->load->view('invalid_ip', $data);
        }
	}

	public function manager()
	{
		if($this->session->userdata('admin_login') != "1"){
			redirect('/netManager/admin_login', 'location');
		}

		$this->load->view('templates/header');
		$data['query'] = $this->manager_model->show_user();
		$this->load->view('manager', $data);
	}

	public function login()
	{
		$data['online'] = $this->manager_model->check_status();	
		$data['remain_time'] = "10:00";
		$data['message'] = "";

		if( $data['online'] === FALSE){	
			$this->load->view('templates/header');
			$this->load->view('login', $data);		
		}
		else {
			$this->load->view('templates/header');
			$this->load->view('login', $data);
		}
	}

	public function ip_manager(){
		if($this->session->userdata('admin_login') != "1"){
			redirect('/netManager/admin_login', 'location');
		}
		$data['title'] = "IP Manager";
		$data['query'] = $this->manager_model->get_ip_list();	

		$this->load->view('templates/header');
		$this->load->view('ip_manager', $data);		
    }


	public function admin_login(){
		$data['message'] = "";
		$this->load->view('templates/header');
		$this->load->view('admin_login', $data);		
	}

	public function admin_login_account(){

		$this->form_validation->set_message('required', '必填');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules('account', 'account', 'required|max_length[16]');
		$this->form_validation->set_rules('password', 'password', 'required|max_length[16]');

		$data['message'] = "";

		if ($this->form_validation->run() === FALSE)
		{
			$data['online'] = FALSE;
		    $this->load->view('templates/header', $data);
		    $this->load->view('admin_login', $data);
		}
		else
		{
			$account = $this->security->xss_clean($this->input->post('account'));
			$password = $this->security->xss_clean($this->input->post('password'));
			if( $account == "admin" && $password == "1234"){
				$isCorrect = TRUE;
			}
			else{
				$isCorrect = FALSE;
			}
			if($isCorrect == FALSE){
				$data['title'] = "Error";
				$data['message'] = "Your account or password is incorrect.</br>";
				$data['online'] = FALSE;
			    $this->load->view('templates/header', $data);
			    $this->load->view('admin_login', $data);
			}
			else{
				$this->session->set_userdata('admin_login','1');
				redirect('/netManager/manager', 'location');
			}
		}

	}

	public function admin_logout(){
		$this->session->set_userdata('admin_login', '0');
		redirect('/netManager/index', 'location');
	}

	public function logout()
	{
		$ip = $this->input->ip_address();
		$this->manager_model->change_status($ip);
		redirect('/netManager/index', 'location');
	}

	public function change_network_status($ip)
	{
		$this->manager_model->change_status($ip);
		redirect('/netManager/manager', 'location');
	}

	public function enable_network()
	{
		redirect('/netManager/manager', 'location');
	}

    public function change_office_status($account)
	{
		$this->manager_model->change_office($account);
		redirect('/netManager/manager', 'location');
	}

	public function login_account()
	{

		$this->form_validation->set_message('required', '必填');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules('account', 'account', 'required|max_length[16]');
		$this->form_validation->set_rules('password', 'password', 'required|max_length[16]');

		$data['message'] = "";

		if ($this->form_validation->run() === FALSE)
		{
			$data['online'] = FALSE;
		    $this->load->view('templates/header', $data);
		    $this->load->view('login', $data);
		}
		else
		{
			$isCorrect = $this->manager_model->check_user();	
			if($isCorrect == FALSE){
				$data['title'] = "Error";
				$data['message'] = "Your account or password is incorrect.</br>";
				$data['online'] = FALSE;
			    $this->load->view('templates/header', $data);
			    $this->load->view('login', $data);
			}
			else{
				$this->manager_model->login_user();
				redirect('/netManager/index', 'location');
			}
		}
	}

	public function add_ip(){

		if($this->session->userdata('admin_login') != "1"){
			redirect('/netManager/admin_login', 'location');
		}

		$data['title'] = 'Add IP';
		$this->load->view('templates/header', $data);
		$this->load->view('add_ip', $data);
	}

	public function set_ip(){

		if($this->session->userdata('admin_login') != "1"){
			redirect('/netManager/admin_login', 'location');
		}

		$this->manager_model->set_ip();	
		redirect('/netManager/manager', 'location');
	}

	public function delete_ip(){

		if($this->session->userdata('admin_login') != "1"){
			redirect('/netManager/admin_login', 'location');
		}

		$this->manager_model->delete_ip();	
		redirect('/netManager/manager', 'location');
	}


    public function blacklist(){

		if($this->session->userdata('admin_login') != "1"){
			redirect('/netManager/admin_login', 'location');
		}

		$data['title'] = 'BlackList';
		$data['query'] = $this->manager_model->show_blacklist();
		$this->load->view('templates/header', $data);
		$this->load->view('blacklist', $data);
	}

    public function add_blacklist(){

		if($this->session->userdata('admin_login') != "1"){
			redirect('/netManager/admin_login', 'location');
		}

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('app_name', 'app_name', 'required');
        $this->form_validation->set_rules('ip', 'ip', 'required|callback_check_same');

        if ($this->form_validation->run() == FALSE) {
            $data['query'] = $this->manager_model->show_blacklist();
            $this->load->view('templates/header', $data);
            $this->load->view('blacklist',$data);
        }
        else
        {
            $this->manager_model->add_blacklist();
		    redirect('/netManager/blacklist', 'location');
        }
	}

    public function check_same($ip){
        $query = $this->db->get('blacklist'); 
        foreach ($query->result() as $row)
        {
            if( $row->ip == $ip){
                $this->form_validation->set_message('check_same', 'This ip is allready exist.');
                return FALSE;
            }
        }
        return TRUE;
    }

    public function remove_blacklist($ip){

		if($this->session->userdata('admin_login') != "1"){
			redirect('/netManager/admin_login', 'location');
		}
        $this->manager_model->remove_blacklist($ip);
		redirect('/netManager/blacklist', 'location');
	}
}

