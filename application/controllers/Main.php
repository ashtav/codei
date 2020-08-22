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
		
		$auth = _getwhere('users', ['email' => $email])->row_array();
		
		if(password_verify($password, $auth['password'])){
			if($auth['status'] == 'waiting'){
				$this->output->set_header('HTTP/1.0 400 Login gagal, menunggu konfirmasi.');
				return;
			}

			$user = _getwhere('users', ['id' => $auth['id']])->row_array();
			$token = generate_random_string(50);

			$data_session = [
				'id' => $auth['id'],
				'nama' => $user['nama'],
				'email' => $email,
				'status' => 'logged',
				'token' => $token,
			];

			$this->session->set_userdata($data_session);

			echo json_encode($auth);
		}else{
			$this->output->set_header('HTTP/1.0 400 Login gagal.');
		}
		
	}
}
