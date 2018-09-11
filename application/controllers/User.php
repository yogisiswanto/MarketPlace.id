<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){

		parent::__construct();
		$this->load->model('User_Model');
		// $this->load->library('form_validation');
	}

	// function index
	public function index(){

		// when session is empty
		if (!isset($this->session->login_status)) {
			
			// displaying User_Login_Form
			$this->load->view('User/User_Login_Form');
		
		// when session is not empty and user status is 0
		}else if($this->session->user_status == 0){

			// setting notification when login is success
			$this->session->set_flashdata('notification', 'login-success');

			// redirect to User_Activation_Form
			redirect(site_url().'/User/User_Activation_Form');
			
		// when session is not empty and user status is 1
		}else{

			// displaying welcome_page
			$this->load->view('User/welcome_page');
		}
		
	}

	// function User_Login
	public function User_Login(){
		
		// configuration for User_Login_Form validation
		$config = array(
			
			array(
                'field' => 'user_name',
                'label' => 'Username',
				'rules' => 'required',
				'errors'=> array('required' => '{field} masih kosong')
			),

			array(
                'field' => 'user_password',
                'label' => 'Password',
				'rules' => 'required',
				'errors'=> array('required' => '{field} masih kosong')
			),

		);

		// setting confiuration onto set_rules
		$this->form_validation->set_rules($config);

		// if value form validation is false, it return to User_Login_Form again and will display errors message
		if ($this->form_validation->run() == FALSE){

			$this->load->view('User/User_Login_Form');
		
		// if value form validation is true, it will prosses code bellow
		}else{

			$username = $this->input->post('user_name');
			$password = md5($this->input->post('user_password'));

			$result = $this->User_Model->get($username, $password);

			// debug($password);

			if ($result->num_rows() == 0) {
				
				// setting notification when login is fail
				$this->session->set_flashdata('notification', 'login-fail');

				// redirect into User/index
				redirect(site_url().'/User/index');
			
			}else{

				// data login from user
				$user = array(
					'user_id'			=> $result->row()->user_id,
					'user_full_name' 	=> $result->row()->user_full_name,
					'user_status'		=> $result->row()->user_status,
					'login_status'		=> TRUE,
				);

				// inserting user data into session
				$this->session->set_userdata($user);

				// setting notification when login is success
				$this->session->set_flashdata('notification', 'login-success');

				// redirect to User_Activation_Form
				redirect(site_url().'/User/User_Activation_Form');
				
				// debug($this->session->has_userdata('user_full_name'));
			}

		}
		
	}

	// function User_Registration_Form
	public function User_Registration_Form(){

		// when session is empty
		if (!isset($this->session->login_status)) {
			
			// displaying User_Registration_Form
			$this->load->view('User/User_Registration_Form');
		
		// when session is not empty and user status is 0
		}else if($this->session->user_status == 0){

			// setting notification when login is success
			$this->session->set_flashdata('notification', 'login-success');

			// redirect to User_Activation_Form
			redirect(site_url().'/User/User_Activation_Form');
			
		// when session is not empty and user status is 1
		}else{

			// displaying welcome_page
			$this->load->view('User/welcome_page');
		}
	}

	// function User_Registration
	public function User_Registration(){
		
		// configuration for User_Registration_Form validation
		$config = array(
			
			array(
                'field' => 'user_full_name',
                'label' => 'Nama Lengkap',
                'rules' => 'required',
				'errors'=> array('required' => '{field} masih kosong')
			),

			array(
                'field' => 'user_name',
                'label' => 'Username',
                'rules' => 'required',
				'errors'=> array('required' => '{field} masih kosong')
			),

			array(
                'field' => 'user_password',
                'label' => 'Password',
                'rules' => 'required',
				'errors'=> array('required' => '{field} masih kosong')
			),

			array(
                'field' => 'user_retype_password',
                'label' => 'Retype Password',
                'rules' => 'required|matches[user_password]',
				'errors'=> array('required' => '{field} masih kosong')
			),

			array(
                'field' => 'user_email',
                'label' => 'Email',
                'rules' => 'required',
				'errors'=> array('required' => '{field} masih kosong')
			),

			array(
                'field' => 'user_phone_number',
                'label' => 'Nomor Handphone',
                'rules' => 'required|callback_user_phone_number_check',
				'errors'=> array('required' => '{field} masih kosong')
			),
		);

		// setting confiuration onto set_rules
		$this->form_validation->set_rules($config);

		// if value of form validation is false, it return to User_Registration_Form again and will display errors message
		if ($this->form_validation->run() == FALSE){

			// setting notification when data is not insert
			$this->session->set_flashdata('notification', 'warning');

			$this->load->view('User/User_Registration_Form');
		
		// if value of form validation is true, it will prosses code bellow
		}else {
			
			// get data from User_Registration_Form
			$data = $this->input->post();

			// delete user_retype_password
			unset($data['user_retype_password']);

			// change user_password into md5 hash
			$data['user_password'] = md5($this->input->post('user_password'));

			// setting user_status
			$data['user_status'] = 0;
			
			// insert into database
			$result = $this->User_Model->insert($data);

			// setting notification when data is insert
			$this->session->set_flashdata('notification', 'success');
			
			// redirect into User/index
			redirect(site_url().'/User/index');

		}
	}

	// function User_Activation_Form
	public function User_Activation_Form(){

		

		// when session is empty
		if (!isset($this->session->login_status)) {
			
			// redirect into User/index
			redirect(site_url().'/User/index');
		
		// when session is not empty and user status is 0
		}else if($this->session->user_status == 0){

			// displaying User_Activation_Form
			$this->load->view('User/User_Activation_Form');
			
		// when session is not empty and user status is 1
		}else{

			// displaying welcome_page
			$this->load->view('User/welcome_page');
		}		
	}

	// function User_Activation
	public function User_Activation(){
		
		// configuration for User_Activation_Form validation
		$config = array(
			
			array(
                'field' => 'activation_code',
                'label' => 'Kode Aktivasi',
				'rules' => 'required',
				'errors'=> array('required' => '{field} masih kosong')
			),

		);

		// setting confiuration onto set_rules
		$this->form_validation->set_rules($config);

		// if value of form validation is false, it return to User_Activation_Form again and will display errors message
		if ($this->form_validation->run() == FALSE){

			$this->load->view('User/User_Activation_Form');
		
		// if value of form validation is true, it will prosses code bellow
		}else {

			$this->load->view('formsucces');

		}

	}

	// funtion validate unique user_phone_number
	public function user_phone_number_check($user_phone_number){
		
		// get from database
		$result = $this->User_Model->check_phone_number($user_phone_number);

		// if user_phone_number is exist, it will show error message
		if ($result == 1) {
			
			$this->form_validation->set_message('user_phone_number_check', '{field} sudah pernah digunakan');
			return FALSE;
		
		// if user_phone_number is not exist
		}else{
		
			return TRUE;
		}
	}

	public function user_phone_number_check_for_jquery(){

		$user_phone_number = $this->input->post('user_phone_number');
		
		// get from database
		$result = $this->User_Model->check_phone_number($user_phone_number);

		// if user_phone_number is exist, it will show error message
		if ($result == 1) {
			
			echo 1;
		
		// if user_phone_number is not exist
		}else{
		
			echo 0;
		}
		
	}

	public function logout(){
		
		// when session is empty
		if (!isset($this->session->login_status)) {
			
			// redirect into User/index
			redirect(site_url().'/User/index');
		
		// when session is not empty and user status is 0
		}else{

			// destroying session
			$this->session->sess_destroy();

			// redirect into User/index
			redirect(site_url().'/User/index');
		}
	}
}
