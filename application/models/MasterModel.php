<?php
class MasterModel extends CI_MODEL{
    public function getAll($param){
        return $this->db->get($param['table'])->result();
    }
    public function getAllWhere($param){
        return $this->db->where($param['where'])->get($param['table'])->result();
    }
    public function getDataTable($param){
        // $records                = $this->db->limit($param['limit'], $param['offset'])->get($param['table'])->result();
        $records                = $this->db->limit($param['limit'], $param['offset'])->get($param['table'])->result();
        $totalDisplayRecords    = $this->db->limit($param['limit'], $param['offset'])->from($param['table'])->count_all_results();
        $totalRecords           = $this->db->count_all($param['table']);

        return ['records' => $records, 'totalDisplayRecords' => $totalDisplayRecords, 'totalRecords' => $totalRecords];
    }
}