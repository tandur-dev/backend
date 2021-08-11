<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Master extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('MasterModel');
    }

    public function provinsi_get(){
        $provs = $this->MasterModel->getAll(['table' => 'md_provinsi']);

        if($provs != null){
            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $provs], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);
        }
    }
    
    public function kota_get($idProv){        
        $kotas = $this->MasterModel->getAllWhere(['table' => 'md_kota', 'where' => ['ID_PROVINSI' => $idProv]]);
        
        if($kotas != null){
            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $kotas], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);
        }
    }
    
    public function kecamatan_get($idKota){
        $kecamatans = $this->MasterModel->getAllWhere(['table' => 'md_kecamatan', 'where' => ['ID_KOTA' => $idKota]]);
        
        if($kecamatans != null){
            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $kecamatans], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);
        }
        
    }
    
    public function kelurahan_get($idKecamatan){
        $kelurahans = $this->MasterModel->getAllWhere(['table' => 'md_kelurahan', 'where' => ['ID_KECAMATAN' => $idKecamatan]]);
        
        if($kelurahans != null){
            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $kelurahans], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);
        }
    }

}