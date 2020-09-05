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

		$data['data'] = $this->db->select('*,rumah_sakit.nama as rsn,pemeriksaan.jadwal_hari as jh,pemeriksaan.status as sp,pemeriksaan.id as idp')->order_by('pemeriksaan.id','desc')->from('pemeriksaan')->where('pemeriksaan.deleted_at', null)->where('pemeriksaan.id_rumahsakit', $rs['id'])->join('rumah_sakit', 'rumah_sakit.id = pemeriksaan.id_rumahsakit')->join('dokter', 'dokter.id = pemeriksaan.id_dokter')->get()->result_array();
		$this->load->view('pages/dashboard/pemberitahuan/pemberitahuan', $data);
	}

	public function accept($id){
		$data = _getwhere('pemeriksaan', ['id' => $id])->row_array();
		_update('pemeriksaan', ['id' => $id], ['status' => 'diterima', 'keterangan' => post('keterangan'), 'notif_ke' => $data['created_by']]);
	}

	public function reject($id){
		$data = _getwhere('pemeriksaan', ['id' => $id])->row_array();
		_update('pemeriksaan', ['id' => $id], ['status' => 'ditolak', 'keterangan' => post('keterangan'), 'notif_ke' => $data['created_by']]);
	}

}
