<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UrbanFarming extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('UrbanFarmingModel');
        $this->load->model('LahanModel');
        $this->load->model('UserModel');
    }

    public function index_post(){
        $param = $this->post();
        
        if(!empty($param['idLahan']) && !empty($param['email']) && !empty($param['tgl']) && !empty($param['tglSelesai']) && !empty($param['totBayar'])){
           $user = $this->UserModel->get(['filter' => ['EMAIL_USER' => $param['email']]]);
           $lahan = $this->LahanModel->get(['filter' => ['ID_LAHAN' => $param['idLahan']]]);
           if($user != null && $lahan != null){
               $idUrban = "URB_".md5(time());

               $storeUrban['ID_URBAN']          = $idUrban;
               $storeUrban['ID_LAHAN']          = $param['idLahan'];
               $storeUrban['EMAIL_USER']        = $param['email'];
               $storeUrban['TGL_URBAN']         = $param['tgl'];
               $storeUrban['TGLSELESAI_URBAN']  = $param['tglSelesai'];
               $storeUrban['TOTBAYAR_URBAN']    = $param['totBayar'];
               $this->UrbanFarmingModel->insert($storeUrban);

               $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan'], 200);
           }else{
               $this->response(['status' => false, 'message' => 'Email user atau lahan tidak terdaftar'], 200);
           }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }

    public function selesai_post(){
        $param = $this->post();

        if(!empty($param['idUrban']) && !empty($param['bintang']) && !empty($param['ulasan'])){
            $urban = $this->UrbanFarmingModel->get(['filter' => ['ID_URBAN' => $param['idUrban']]]);
            if($urban != null){
                $storeUrban['ID_URBAN']             = $param['idUrban'];
                $storeUrban['BINTANG_URBAN']        = $param['bintang'];
                $storeUrban['ULASAN_URBAN']         = $param['ulasan'];
                $storeUrban['TGLULASAN_URBAN']      = date('Y-m-d');
                $storeUrban['ISFINISHED_URBAN']     = "1";
                $storeUrban['updated_at']           = date('Y-m-d H:i:s');
                $this->UrbanFarmingModel->update($storeUrban);

                $lahan = $this->LahanModel->getBintang(['idLahan' => $urban[0]->ID_LAHAN]);
                $updateLahan['ID_LAHAN']        = $urban[0]->ID_LAHAN;
                $updateLahan['BINTANG_LAHAN']   = $lahan->BINTANG;
                $updateLahan['updated_at']      = date('Y-m-d H:i:s');
                $this->LahanModel->update($updateLahan);

                $this->response(['status' => false, 'message' => 'Data berhasil ditambahakan'], 200);
            }else{
                $this->response(['status' => false, 'message' => 'Urban farming tidak terdaftar'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }

}