<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('fn');
    }

	public function index($action = 'view', $id = 0){
		switch ($action) {
			case 'view':

				$page = get('page');
				$perPage = get('perPage');

				$limit = $perPage;
				$start = $page * $perPage - $perPage;

				if(!$page || !$perPage){ $limit = 5; $start = 0; }

				$data['page'] = !$page ? 1 : $page;
				$data['users'] = $this->mod->get_limit('users', $limit, $start)->result_array();

				if( get('q') ){
					$data['users'] = $this->mod->search('users', 'nama', get('q'))->result_array();
				}
				$this->load->view('pages/index', $data);
				break;

			case 'new':
				$data = [
					'nim' => post('nim'),
					'nama' => post('nama','ucwords'),
					'tempat_lahir' => post('tempat_lahir'),
					'tanggal_lahir' => post('tanggal_lahir'),
					'jenis_kelamin' => post('jenis_kelamin'),
					'alamat' => post('alamat'),
					'telepon' => post('telepon'),
				];

				$this->db->insert('users', $data); // tambah data produk
				break;

			case 'get':
				echo json_encode($this->mod->get_where('users', ['id' => $id])->row_array());
				break;

			case 'edit':
				$data = [
					'nim' => post('nim'),
					'nama' => post('nama','ucwords'),
					'tempat_lahir' => post('tempat_lahir'),
					'tanggal_lahir' => post('tanggal_lahir'),
					'jenis_kelamin' => post('jenis_kelamin'),
					'alamat' => post('alamat'),
					'telepon' => post('telepon'),
				];

				$this->mod->update('users', 'id', $id, $data);
				break;

			case 'delete':
				$this->mod->delete('users', 'id', $id); // hapus data produk
				break;

			case 'pagination':
				$num_product = $this->mod->get_data('users')->num_rows();
				if( post('q') ){
					$num_product = $this->mod->search('users', 'name', post('q'))->num_rows();
				}

				$data = [
					'num_product' => $num_product
				];

				echo json_encode($data);
				break;

		}


	}
}
