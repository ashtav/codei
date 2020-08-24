<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');

		if(!auth('email')){
			redirect('./');
		}
	}

	public function index(){
		$data['terdaftar'] = _getwhere('rumah_sakit', ['created_by' => auth('id')])->num_rows();
		$this->load->view('pages/dashboard/home/home', $data);
	}

}
