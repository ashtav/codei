<?php

  // helper, created by ashta

  // _get('users')->result_array();
  // function _get($table){
  //   $ci = &get_instance();
  //   return $ci->db->get($table);
  // }

  function _getAuth(){
    $data = _getjoin('users|user_details','id|user_id','*','users')->where(['users.id' => auth('id')])->get()->row_array();
    unset($data['password']);
    return $data;
  }

  // _getwhere('users', ['email' => 'lorem@gmail.com']) ? ->num_rows(), ->row_array(), etc
  function _getwhere($table, $where){
    $ci = &get_instance();
    return $ci->db->where('deleted_at', null)->get_where($table, $where);
  }

  // _getjoin('users','user_details','id|user_id')->get()->result_array();
  function _getjoin($table, $join, $select = '*', $_){
    $ci = &get_instance();

    $t = explode('|',$table);
    $j = explode('|',$join);

    return $ci->db->select($select)->from($t[0])->where($_.'.deleted_at', null)
      ->join($t[1], $t[0].'.'.$j[0].' = '.$t[1].'.'.$j[1]);
  }

  // _update('users', ['id' => $id], ['status' => 'active']);
  function _update($table, $where, $data){
    $ci = &get_instance();
    $ci->db->where($where)->update($table, $data);
  }

  // _delete('users', ['id' => $id]);
  function _delete($table, $where){
    $ci = &get_instance();
    $ci->db->where($where)->update($table, ['deleted_at' => dateTime()]);
  }

  // _deleteAll('users');
  function _deleteAll($table){
    $ci = &get_instance();
    $ci->db->empty_table($table);
  }

  function forceDelete($table, $where){
    $ci = &get_instance();
    $ci->db->where($where)->delete($table);
  }

  // $filename = putfile('file', 'images')
  function putfile($input, $dir){
    $ci = &get_instance();
		if( empty($_FILES[$input]['name']) ){
			return null;
		}else{
			$filename = round(microtime(true)).'.jpg';
			$config['file_name'] 						= $filename;
			$config['upload_path']          = $dir;
			$config['allowed_types']        = '*';
			$config['max_size']             = 50000;
			$config['max_width']            = 50000;
			$config['max_height']           = 50000;

			$ci->load->library('upload', $config);
			$ci->upload->do_upload($input);

			return $filename;
		}
  }
  
  function removeFile($url){
    if(file_exists($url)){
			unlink($url);
		}
  }



  // ==========

  // if( !auth('email') )
  function auth($value){
    $ci = &get_instance();
		return $ci->session->userdata($value);
  }
  
  // hash password -> hasp('secret')
  function hasp($password){
    $options = ['cost' => 12];
    return password_hash($password, PASSWORD_BCRYPT, $options);
  }

  // url('page')
  function url($url = '/'){
    return base_url($url);
  }

  function destroySession($redirect_to = './'){
    $ci = &get_instance();
		$ci->session->sess_destroy();
		redirect(base_url($redirect_to));
  }









  // WAKTU SAAT INI
  function dateTime($format = 'Y-m-d h:i:s'){
    date_default_timezone_set('Asia/Singapore');
    return date($format);
  }

  // GENERATE STRING
  function generate_random_string($length = 10) {
    $characters = '_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  // WAKTU KADALUARSA
  function time_expired($datetime){
    date_default_timezone_set('Asia/Singapore');
    $timestamp = strtotime($datetime);
    $now = strtotime(date('Y-m-d H:i:s'));
    $date = $timestamp + 86400; // 86400 = 24 jam

    if($now >= $date){ return 0;
    }else{ return 1; }
  }

  function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
  }

  function replace_between($str, $needle_start, $needle_end, $replacement) {
    $pos = strpos($str, $needle_start);
    $start = $pos === false ? 0 : $pos + strlen($needle_start);

    $pos = strpos($str, $needle_end, $start);
    $end = $start === false ? strlen($str) : $pos;

    return str_replace($needle_start.''.$needle_end,'',substr_replace($str,$replacement,  $start, $end - $start));
  }

  // MENGHITUNG WAKTU (LAMANYA)
  function time_elapsed($datetime, $full = false){
    date_default_timezone_set('Asia/Singapore');
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            // $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    $text = implode(', ', $string);

    if(stripos($text, "hari") == true || stripos($text, "minggu") == true || stripos($text, "bulan") == true || stripos($text, "tahun") == true) {
      return $string ? ''. implode(', ', $string) . ' yang lalu' : ' baru saja';
    }else{
      return $string ? ''. implode(', ', $string) . ' yang lalu' : ' baru saja';
    }
  }

  // BERSIHKAN STRING DARI KARAKTER TERTENTU
  function clear_str($str){
    return str_replace(array('[removed]','removed','&lt;?php','?&gt;'), array('','','',''), $str);
  }

  // AMBIL HURUF AWAL SETIAP STRING
  function get_first_char($str, $num = 1){
    return strtoupper(substr(preg_replace('/(\B.|\s+)/','',$str),0,$num));
  }

  // FORMAT PENOMORAN
  function _num($string){
    return number_format($string, 0, '', '.');
  }

  function _date($date, $format = 'd-m-Y'){
    return date($format, strtotime($date));
  }

  function _empty($css = 'my-3'){
    echo "<div class='text-center $css'> <img src='./assets/images/no-data.png' height='150'> </div>";
  }

  function post($input, $style = ''){
    $ci = &get_instance();
		$str = $ci->input->post($input);
		if($style){
			return $style == 'ucwords' ? ucwords($str) : strtolower($str);
		}else{
			return $str;
		}
	}

  function load($page, $data = false){
    $ci = &get_instance();
		return $data ? $ci->load->view($page, $data) : $ci->load->view($page);
  }

  function part($page, $data = false){
    $ci = &get_instance();
		return $data ? $ci->load->view('partials/'.$page, $data) : $ci->load->view('partials/'.$page);
  }

  function modal($page, $data = false){
    $ci = &get_instance();
		return $data ? $ci->load->view('modals/'.$page, $data) : $ci->load->view('modals/'.$page);
  }

  function get($input){
    $ci = &get_instance();
		return $ci->input->get($input);
	}

	function sess($v){
    $ci = &get_instance();
		return $ci->session->userdata($v);
	}

  

  

  function _auth($nim, $password){
    $ci = &get_instance();
    $check = $ci->mod->get_where('users', ['nim' => $nim])->row_array();
    if(password_verify($password, $check['password'])){
      $token = generate_random_string(50);
      $user = $ci->mod->get_where('users', 'id = '.$check['id'])->row_array();
      $data_session = array(
        'id' => $check['id_user'],
        'nim' => $nim,
        'nama' => $user['nama'],
        'status' => 'logged',
        'token' => $token,
      );

      $ci->session->set_userdata($data_session);
      $data = array( 'tgl_masuk' => date_time(), 'token' => $token);
      _update('tb_login', 'id_user', $check['id_user'], $data);
      return json_encode(['status'=> 200, 'level' => $check['level'], 'id' => $check['id_user']]);
    }else{
      return json_encode(['status'=> 400]);
    }
  }

  function _checkMail($table, $email){
    $ci = &get_instance();
    $check = $ci->mod->get_where($table, ['email' => $email])->num_rows();
    return $check > 0 ? true : false;
  }


  // SHORT CRUD
  function _insert($table, $data){
    $ci = &get_instance();
    $ci->db->insert($table, $data);
  }


  // function _getWhere($table){
  //   $ci = &get_instance();
  //   return $ci->mod->get_where($table, $condition, $order);
  // }

  function joinWhere($table1, $table2, $joinBy, $where, $value, $order){
    $ci = &get_instance();
    return $ci->mod->get_join_where($table1, $table2, $joinBy, $where, $value, $order);
  }

  

?>
