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
		$data['jmlpemeriksaan'] = _getWhere('pemeriksaan',['created_by' => auth('id')])->num_rows();

		$notif = 0;

		$query = $this->db->select('*,rumah_sakit.created_by as rs_owner')->from('pemeriksaan')->where('pemeriksaan.deleted_at', null)->join('rumah_sakit', 'rumah_sakit.id = pemeriksaan.id_rumahsakit')->get()->result_array();

		foreach ($query as $v) {
			if(auth('id') == $v['notif_ke']){
				$notif += 1;
			}
		}

		$data['notif'] = $notif;

		if(auth('role') == 'admin_rs'){
			$rs = _getwhere('rumah_sakit', ['created_by' => auth('id')])->row_array();
			$data['dokter'] = _getWhere('dokter', ['created_by' => $rs['id']])->num_rows();
		}

		$this->load->view('pages/dashboard/home/home', $data);
	}

}
