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
		$data['auth'] = _getAuth();
		$data['terdaftar'] = _getwhere('rumah_sakit', ['created_by' => auth('id'), 'status' => 'waiting'])->num_rows();
		$data['has'] = _getwhere('rumah_sakit', ['created_by' => auth('id'), 'status' => 'active'])->num_rows() == 1;

		if(auth('role') == 'admin_rs'){
			$rs = _getwhere('rumah_sakit', ['created_by' => auth('id')])->row_array();
			$data['dokter'] = _getWhere('dokter', ['created_by' => $rs['id']])->num_rows();
		}

		$this->load->view('pages/dashboard/home/home', $data);
	}

}
