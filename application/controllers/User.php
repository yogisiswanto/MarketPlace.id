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
		$this->load->library('Lcg');
		$this->load->library("Rc6");
		$this->load->library("Hotp");
		$this->load->library("Date");
		$this->load->library("Sms");
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

		// setting configuration into set_rules
		$this->form_validation->set_rules($config);

		// if value form validation is false, it return to User_Login_Form again and will display errors message
		if ($this->form_validation->run() == FALSE){

			$this->load->view('User/User_Login_Form');
		
		// if value form validation is true, it will prosses code bellow
		}else{

			// getting username and password from User_Login_Form
			$username = $this->input->post('user_name');
			$password = md5($this->input->post('user_password'));

			// checking username and password on database
			$result = $this->User_Model->get($username, $password);

			// when username and password dismatch
			if ($result->num_rows() == 0) {
				
				// setting notification when login is fail
				$this->session->set_flashdata('notification', 'login-fail');

				// redirect into User/index
				redirect(site_url().'/User/index');
			
			// when username and password is match			
			}else{

				// data login from user
				$user = array(
					'user_id'			=> $result->row()->user_id,
					'user_full_name' 	=> $result->row()->user_full_name,
					'user_status'		=> $result->row()->user_status,
					'user_phone_number'	=> $result->row()->user_phone_number,
					'login_status'		=> TRUE,
					'seed'				=> $result->row()->user_phone_number,
					'otp_count'			=> 0,
				);

				// inserting user data into session
				$this->session->set_userdata($user);

				// setting notification when login is success
				$this->session->set_flashdata('notification', 'login-success');

				// redirect to User_Activation_Form
				redirect(site_url().'/User/User_Activation_Form');
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

		// setting configuration into set_rules
		$this->form_validation->set_rules($config);

		// if value of form validation is false, it return to User_Registration_Form again and will display errors message
		if ($this->form_validation->run() == FALSE){

			// setting notification when data is not insert
			$this->session->set_flashdata('notification', 'warning');

			// redirect into User/User_Registration_Form
			redirect(site_url().'/User/User_Registration_Form');
		
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
			$this->session->set_flashdata('notification', 'registration-success');
			
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
		}else if($this->session->user_status == 0 && $this->session->otp_count < 3){

			// generating and sending activation code
			$this->generateOTP();

			// displaying User_Activation_Form
			$this->load->view('User/User_Activation_Form');

		// when session is not empty and user status is 0
		}else if($this->session->otp_count == 3){

			// displaying User_Activation_Form
			$this->load->view('User/Forbiden');
		
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

			// getting activation code from User_Activation_Form
			$activationCode = $this->input->post('activation_code');

			// getting user_id from session
			$userId = $this->session->user_id;

			// getting activation code
			$result = $this->User_Model->getActivationCode($userId, $activationCode);

			// when activation code is match
			if ($result == 1) {

				// update user_status
				$update = array(
					'user_id'			=> $this->session->user_id,
					'user_status'		=> 1,
				);

				// update user_status
				$updateResult = $this->User_Model->update($update);
				
				// direct to formsucces
				$this->load->view('User/welcome_page');
			
			// when activation code is not match
			}else{

				// setting notification when activation code is dismatch
				$this->session->set_flashdata('notification', 'activation-code-dismatch');

				// redirect to User_Activation_Form
				redirect(site_url().'/User/User_Activation_Form');
			}
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

	public function generateOTP()
	{
		// getting user phone number
		$phoneNumber = $this->session->user_phone_number;

		// using user phone number as seed
		$seed = $this->session->seed;

		// generate key for encryption using LCG
		$key = $this->lcg->random($seed);

		// update seed with new value from lcg
		$this->session->set_userdata('seed', $key);

		// getting plaintext from date (YYYYmmddHis)
		$plaintext = $this->date->get();

		// getting keyScheduling from key
		$keyScheduling = $this->rc6->keySchedule($key);

		// encryption plaintext using RC6 algorithm and keyScheduling
		$cipherText = $this->rc6->encrypt($plaintext, $keyScheduling);
		$decryption = $this->rc6->decrypt($cipherText, $keyScheduling);

		// getting current OTP generation
		$otpCount = $this->session->otp_count;

		// make 6 digit otp using HOTP method
		$otp = $this->hotp->make($cipherText, $otpCount);

		// counting otp generation
		$otpCount = $this->session->otp_count + 1;

		// updating otp generation
		$this->session->set_userdata('otp_count', $otpCount);

		// getting plaintext formated (YYYY-mm-dd H:i:s)
		$dateTime = $this->date->getDateTime($plaintext);

		// update data after generate otp
		$update = array(
			'user_id'			=> $this->session->user_id,
			'key_encryption' 	=> $key,
			'time_generate'		=> $dateTime,
			'activation_code'	=> $otp['code'],
		);

		// update key, time generate and otp
		$updateResult = $this->User_Model->update($update);

		//sending 6 digit otp using sms gateway
		// $status = $this->sms->send($seed, $otp);

		$data = array();

		$data['updateResult'] = $updateResult;
		$data['otpCount'] = $otpCount;
		$data['seed'] = $seed;
		$data['dateTime'] = $dateTime;
		$data['plaintext'] = $plaintext;
		$data['key'] = $key;
		$data['keyScheduling'] = $keyScheduling;
		$data['cipherText'] = $cipherText;
		$data['decryption'] = $decryption;
		$data['otp'] = $otp['code'];
		$data['HMAC'] = $otp['HMAC'];
		// $data['status'] = $status;

		// debug($data);
	}

	public function testHotp()
	{
		$hotp = array();

		$hotp = $this->hotp->make("123456789", 1);
		debug($hotp);
	}

	public function testLcg()
	{
		$key = $this->lcg->random("081200000000");
		debug($key);
	}

	public function testRC6()
	{
		// getting keyScheduling from key
		$keyScheduling = $this->rc6->keySchedule(12345);

		// encryption plaintext using RC6 algorithm and keyScheduling
		$cipherText = $this->rc6->encrypt("Yogi Siswanto", $keyScheduling);
		$decryption = $this->rc6->decrypt($cipherText, $keyScheduling);

		$data = array(
					'keyScheduling' => $keyScheduling, 
					'encryption' => $cipherText,
					'decryption' => $decryption					
				);

		debug($data);
	}
}