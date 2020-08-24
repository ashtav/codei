<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RumahSakit extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');

		if(!auth('email')){
			redirect('./');
		}
	}

	public function index(){
		$data['waiting'] = _getjoin('user_details|rumah_sakit','user_id|created_by','*,user_details.nama as un')->where(['status' => 'waiting'])->get()->result_array();
		$data['data'] = _getjoin('user_details|rumah_sakit','user_id|created_by','*,user_details.nama as un')->where(['status' => 'active'])->get()->result_array();
		$data['jumlah_rs'] = _getwhere('rumah_sakit', ['status' => 'active'])->num_rows();
		$this->load->view('pages/dashboard/rumah-sakit/rumah-sakit', $data);
	}

	public function register(){
		$data = [
			'nama' => ucwords(post('nama')),
			'alamat' => ucwords(post('alamat')),
			'telepon' => post('telepon'),
			'email' => strtolower(post('email')),
			'jam_buka' => post('jam_buka'),
			'jam_tutup' => post('jam_tutup'),
			'created_by' => auth('id')
		];

		$this->db->insert('rumah_sakit', $data);
	}

	public function confirm($id, $uid){
		_update('rumah_sakit', ['id' => $id], ['status' => 'active']);
		_update('users', ['id' => $uid], ['role' => 'admin_rs']);
	}

	public function rejected($id){
		_delete('rumah_sakit', ['id' => $id]);
	}

	public function delete($id){
		_delete('rumah_sakit', ['id' => $id]);
	}

	public function update($id){
		$data = [
			'nama' => ucwords(post('nama')),
			'alamat' => ucwords(post('alamat')),
			'telepon' => post('telepon'),
			'email' => strtolower(post('email')),
			'jam_buka' => post('jam_buka'),
			'jam_tutup' => post('jam_tutup'),
			'created_by' => auth('id')
		];

		_update('rumah_sakit', ['id' => $id], $data);
	}

}
