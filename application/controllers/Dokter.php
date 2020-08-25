<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');

		if(!auth('email')){
			redirect('./');
		}
	}

	public function store(){
		$rs = _getwhere('rumah_sakit', ['created_by' => auth('id')])->row_array();

		$filename = putfile('file', 'images');

		$data = [
			'nama' => ucwords(post('nama')),
			'spesialis' => ucwords(post('spesialis')),
			'telepon' => post('telepon'),
			'jadwal_hari' => implode(',',post('jadwal_hari')),
			'jam_buka' => post('jam_buka'),
			'jam_tutup' => post('jam_tutup'),
			'foto' => $filename,
			'created_by' => $rs['id']
		];
		
		$this->db->insert('dokter', $data);
	}

	public function update($id){
		$rs = _getwhere('rumah_sakit', ['created_by' => auth('id')])->row_array();
		$dokter = _getwhere('dokter', ['id' => $id])->row_array();

		$filename = putfile('file', 'images');

		$data = [
			'nama' => ucwords(post('nama')),
			'spesialis' => ucwords(post('spesialis')),
			'telepon' => post('telepon'),
			'jadwal_hari' => implode(',',post('jadwal_hari')),
			'jam_buka' => post('jam_buka'),
			'jam_tutup' => post('jam_tutup'),
			'foto' => $filename ?? $dokter['foto'],
			'created_by' => $rs['id']
		];
		
		_update('dokter', ['id' => $id], $data);
	}

	public function delete($id){
		$dokter = _getwhere('dokter', ['id' => $id])->row_array();
		_delete('dokter', ['id' => $id]);

		removeFile('images/'.$dokter['foto']);
	}

}
