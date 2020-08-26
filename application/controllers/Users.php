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
		$data['auth'] = _getAuth();

		$data['waiting'] = _getjoin('users|user_details','id|user_id','*','users')->where(['status' => 'waiting'])->get()->result_array();
		$data['data'] = _getjoin('users|user_details','id|user_id','*','users')->where(['status' => 'active'])->get()->result_array();
		$data['jumlah_user'] = _getwhere('users', ['status' => 'active'])->num_rows();
		$this->load->view('pages/dashboard/users/users', $data);
	}

	public function confirm($id){
		_update('users', ['id' => $id], ['status' => 'active']);
	}

	public function rejected($id){
		_delete('users', ['id' => $id]);
	}

	public function delete($id){
		_delete('users', ['id' => $id]);
	}

	public function update($id){
		$data = [
			'nama' => ucwords(post('nama')),
			'tempat_lahir' => ucwords(post('tempat_lahir')),
			'tanggal_lahir' => post('tanggal_lahir'),
			'jenis_kelamin' => post('jenis_kelamin'),
			'alamat' => ucwords(post('alamat')),
			'telepon' => post('telepon'),
		];

		_update('user_details', ['user_id' => $id], $data);
	}

	public function profil(){
		$data['auth'] = _getAuth();
		$this->load->view('pages/dashboard/users/profil', $data);
	}

	public function update_account($id){
		$email = strtolower(post('email'));

		if(_getwhere('users', ['email' => $email, 'id !=' => $id])->num_rows() > 0){
			$this->output->set_header('HTTP/1.0 400 Email ini sudah terpakai.');
			return;
		}

		$data = [
			'email' => $email,
			'password' => hasp(post('password')),
		];

		_update('users', ['id' => $id], $data);
	}

	public function update_foto(){
		$filename = putfile('file', 'images');
		_update('user_details', ['user_id' => auth('id')], ['foto' => $filename]);
	}

}
