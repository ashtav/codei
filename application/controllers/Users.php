<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');

		if(!auth('email')){
			redirect('./');
		}
	}

	public function index(){
		$data['waiting'] = _getjoin('users|user_details','id|user_id')->where(['status' => 'waiting'])->get()->result_array();
		$data['data'] = _getjoin('users|user_details','id|user_id')->where(['status' => 'active'])->get()->result_array();
		$data['jumlah_user'] = _getwhere('users', ['status' => 'active'])->num_rows();
		$this->load->view('pages/dashboard/users/users', $data);
	}

	public function confirm($id){
		_update('users', ['id' => $id], ['status' => 'active']);
	}

	public function rejected($id){
		_delete('users', ['id' => $id]);
	}

}
