<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberitahuan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');

		if(!auth('email')){
			redirect('./');
		}
	}

	public function index(){
		$data['auth'] = _getAuth();

		$rs = _getwhere('rumah_sakit', ['created_by' => auth('id')])->row_array();

		$data['data'] = $this->db->select('*,rumah_sakit.nama as rsn,pemeriksaan.jadwal_hari as jh,pemeriksaan.status as sp,pemeriksaan.id as idp')->from('pemeriksaan')->where('pemeriksaan.deleted_at', null)->where('pemeriksaan.id_rumahsakit', $rs['id'])->join('rumah_sakit', 'rumah_sakit.id = pemeriksaan.id_rumahsakit')->join('dokter', 'dokter.id = pemeriksaan.id_dokter')->get()->result_array();
		$this->load->view('pages/dashboard/pemberitahuan/pemberitahuan', $data);
	}

	public function accept($id){
		_update('pemeriksaan', ['id' => $id], ['status' => 'diterima', 'keterangan' => post('keterangan')]);
	}



	public function store(){
		$rs = _getwhere('rumah_sakit', ['created_by' => auth('id')])->row_array();

		$data = [
			'id_rumahsakit' => post('id_rumahsakit'),
			'jenis' => post('jenis') == 1 ? 'laboratorium' : 'dokter',
			'id_dokter' => post('id_dokter'),
			'id_lab' => post('id_lab'),
			'jadwal_hari' => post('jadwal_hari'),
			'keterangan' => '',
			'created_by' => auth('id')
		];
		
		$this->db->insert('pemeriksaan', $data);
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
		_delete('pemeriksaan', ['id' => $id]);
	}

}
