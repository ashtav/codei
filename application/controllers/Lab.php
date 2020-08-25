<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');

		if(!auth('email')){
			redirect('./');
		}
	}

	public function store(){
		$rs = _getwhere('rumah_sakit', ['created_by' => auth('id')])->row_array();

		$data = [
			'nama_lab' => ucwords(post('nama_lab')),
			'id_dokter' => post('id_dokter'),
			'jadwal_hari' => implode(',',post('jadwal_hari')),
			'jam_buka' => post('jam_buka'),
			'jam_tutup' => post('jam_tutup'),
			'created_by' => $rs['id']
		];
		
		$this->db->insert('laboratorium', $data);
	}

	public function update($id){
		$rs = _getwhere('rumah_sakit', ['created_by' => auth('id')])->row_array();

		$data = [
			'nama_lab' => ucwords(post('nama_lab')),
			'id_dokter' => post('id_dokter'),
			'jadwal_hari' => implode(',',post('jadwal_hari')),
			'jam_buka' => post('jam_buka'),
			'jam_tutup' => post('jam_tutup'),
			'created_by' => $rs['id']
		];
		
		_update('laboratorium', ['id' => $id], $data);
	}

	public function delete($id){
		_delete('laboratorium', ['id' => $id]);
	}

}
