<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class LahanModel extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $res = $this->db->get('v_lahan')->result();
        return $res;
    }
    public function get($param){
        $filter = !empty($param['filter'])? $param['filter'] : '';
        $res    = $this->db->get_where('v_lahan', $filter)->result();
        return $res;
    }
    public function getUlasan($param){
        $filter = !empty($param['filter'])? $param['filter'] : '';
        $res    = $this->db->get_where('v_lahan_ulasan', $filter)->result();
        return $res;
    }
    public function insert($param){
        $this->db->insert('user', $param);
        return $this->db->insert_id();
    }
    public function update($param){
        $this->db->where('EMAIL_USER', $param['EMAIL_USER'])->update('user', $param);
        return true;
    }
    public function delete($param){
        $this->db->where($param)->delete('user');
        return true;
    }
}