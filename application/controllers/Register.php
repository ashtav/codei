<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');
	}

	public function index(){
		$this->load->view('register');
	}

	public function register(){
		// $data = $this->input->post(); // get semua input

		$email = strtolower(post('email'));

		$user = [
			'email' => $email,
			'password' => hasp(post('password')),
		];

		if(_getwhere('users', ['email' => $email])->num_rows() > 0){
			$this->output->set_header('HTTP/1.0 400 Email ini sudah terpakai.');
			return;
		}
		
		$this->db->insert('users', $user);
		$uid = $this->db->insert_id();

		$user_detail = [
			'user_id' => $uid,
			'nama' => ucwords(post('nama')),
			'tempat_lahir' => ucwords(post('tempat_lahir')),
			'tanggal_lahir' => post('tanggal_lahir'),
			'jenis_kelamin' => post('jenis_kelamin'),
		];

		$this->db->insert('user_details', $user_detail);

		$this->output->set_header('HTTP/1.0 201 OK');
	}

	
}
