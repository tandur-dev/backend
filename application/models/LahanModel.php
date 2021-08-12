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
        if($param['limit'] != '-1'){
            $this->db->limit($param['limit']);
        }
        $res    = $this->db->order_by('TGLULASAN_URBAN', 'desc')->get_where('v_lahan_ulasan', $filter)->result();
        return $res;
    }
    public function getTerdekat($param){
        $limit = $param['limit'] != '-1' ? 'LIMIT '.$param['limit'] : '';
        $res = $this->db->query('
            SELECT 
            l.ID_LAHAN ,
            l.NAMA_LAHAN ,
            ST_DISTANCE_SPHERE(
                point('.$param['long'].', '.$param['lat'].'),
                point(l.LONGITUDE_LAHAN , l.LATITUDE_LAHAN)
            )/1000 as DISTANCE,
            mp.NAMA_PROVINSI ,
            mk.NAMA_KOTA ,
            mk2.NAMA_KECAMATAN ,
            mk3.NAMA_KELURAHAN ,
            l.ALAMAT_LAHAN ,
            l.LATITUDE_LAHAN ,
            l.LONGITUDE_LAHAN 
            FROM lahan l, md_provinsi mp , md_kota mk , md_kecamatan mk2 , md_kelurahan mk3 
            WHERE 
            l.ID_PROVINSI = mp.ID_PROVINSI AND l.ID_KOTA = mk.ID_KOTA AND l.ID_KECAMATAN = mk2.ID_KECAMATAN AND l.ID_KELURAHAN = mk3.ID_KELURAHAN 
            ORDER BY DISTANCE ASC
            '.$limit.'
        ')->result();

        return $res;
    }
    public function insert($param){
        $this->db->insert('lahan', $param);
        return $this->db->insert_id();
    }
    public function update($param){
        $this->db->where('ID_LAHAN', $param['ID_LAHAN'])->update('lahan', $param);
        return true;
    }
    public function delete($param){
        $this->db->where($param)->delete('user');
        return true;
    }
}