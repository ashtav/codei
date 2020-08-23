<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');
	}

	public function index(){
		$this->load->view('index');
	}

	public function signin(){
		$email = strtolower(post('email'));
		$password = post('password');
		
		$auth = _getjoin('users|user_details','id|user_id')->where(['email' => $email])->get()->row_array();
		
		if(password_verify($password, $auth['password'])){
			if($auth['status'] == 'waiting'){
				$this->output->set_header('HTTP/1.0 400 Login gagal, menunggu konfirmasi.');
				return;
			}

			$data_session = [
				'id' => $auth['id'],
				'nama' => $auth['nama'],
				'email' => $auth['email']
			];

			$this->session->set_userdata($data_session);
			echo json_encode($data_session);
		}else{
			$this->output->set_header('HTTP/1.0 400 Login gagal.');
		}
		
	}
}
