<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Lahan extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('LahanModel');
    }
    public function lahanDetail_get($id){
        $lahan = $this->LahanModel->get(['filter' => ['ID_LAHAN' => $id]]);

        if($lahan != null){
            $fasilitas = explode(';', $lahan[0]->FASILITAS_LAHAN);

            $lahan[0]->FASILITAS_LAHAN = array();
            $lahan[0]->FASILITAS_LAHAN['ISIRIGASI_LAHAN']     = $fasilitas[0];
            $lahan[0]->FASILITAS_LAHAN['ISLISTRIK_LAHAN']     = $fasilitas[2];
            $lahan[0]->FASILITAS_LAHAN['ISPERALATAN_LAHAN']   = $fasilitas[2];
            $lahan[0]->FASILITAS_LAHAN['ISKANOPI_LAHAN']      = $fasilitas[3];

            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $lahan[0]], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);        
        }
    }
    public function ulasan_get($idLahan){
        $param = $this->get();
        $ulasans = $this->LahanModel->getUlasan(['filter' => ['ID_LAHAN' => $idLahan, 'ISFINISHED_URBAN' => '1'], 'limit' => $param['limit']]);

        if($ulasans != null){
            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $ulasans], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);        
        }
    }
        
}