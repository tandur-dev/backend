<?php
class MasterModel extends CI_MODEL{
    public function getAll($param){
        return $this->db->get($param['table'])->result();
    }
    public function getAllWhere($param){
        return $this->db->where($param['where'])->get($param['table'])->result();
    }
}