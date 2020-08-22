<?php
// created by: adn94_
defined('BASEPATH') OR exit('No direct script access allowed');

  class Page_model extends CI_Model {

    // ex: $this->mod->get_data('table')
    function get_data($table, $order = false){
      $exp = explode(' ', $order);
      return $order ? $this->db->order_by($exp[0], $exp[1])->get($table)
      : $this->db->get($table);
    }

    // ex: $this->mod->get_where('table', 'id', 1)
    function get_where($table, $where, $order = false){
      $exp = explode(' ', $order);
      return $order ? $this->db->order_by($exp[0], $exp[1])->get_where($table, $where)
      : $this->db->get_where($table, $where);
    }

    // ex: $this->mod->get_field('name', 'id', 1, 'table')
    function get_field($field, $where, $value, $table){
      return $this->db->select($field)->where($where, $value)->get($table)->row_array()[$field];
    }

    // ex: $this->mod->update('table', 'id', 1, ['nama' => 'lorem']);
    function update($table, $where, $value, $data){
      $this->db->where($where, $value)->update($table, $data);
  	}

    /* ex: $this->mod->delete('table') hapus semua
       ex: $this->mod->delete('table', 'id', 1) hapus 1 */
    function delete($table, $where = false, $value = false){
      $where ? $this->db->where($where, $value)->delete($table)
             : $this->db->empty_table($table);
  	}

    // ex: $this->mod->get_limit('table', 5, 0)
    function get_limit($table, $length, $start, $order = false){
      $exp = explode(' ', $order);
      return $order ? $this->db->order_by($exp[0], $exp[1])->get($table, $length, $start)
      : $this->db->get($table, $length, $start);
    }

    // ex: $this->mod->get_limit_where('table', 5, 0, 'id', 1)
    function get_limit_where($table, $length, $start, $where, $value, $order = false){
      $exp = explode(' ', $order);
      return $order ? $this->db->order_by($exp[0], $exp[1])->where($where, $value)->get($table, $length, $start)
      : $this->db->where($where, $value)->get($table, $length, $start);
    }

    // ex: $this->mod->get_join('tb_users', 'tb_login', 'user_id', 'id_user desc')
    function get_join($table1, $table2, $join, $order = false){
      $this->db->select('*')->from($table1)
      ->join($table2, $table1.'.'.$join.'='.$table2.'.'.$join);

      if($order){
        $exp = explode(' ', $order);
        $this->db->order_by($table1.'.'.$exp[0], $exp[1]);
      }

      return $this->db->get();
    }

    // ex: $this->mod->get_join_where('tb_users', 'tb_login', 'user_id', 'user_id', 1, 'id_user desc')
    function get_join_where($table1, $table2, $join, $condition, $value, $order = false){
      $this->db->select('*')->from($table1)
      ->join($table2, $table1.'.'.$join.'='.$table2.'.'.$join)
      ->where($table1.'.'.$condition, $value);

      if($order){
        $exp = explode(' ', $order);
        $this->db->order_by($table1.'.'.$exp[0], $exp[1]);
      }

      return $this->db->get();
    }

}
