<?php
class UrbanFarmingController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('table');
        $this->load->library('upload');
        $this->load->model('UrbanFarmingModel');
    }

    public function index()
    {
        $urbanfarmings = $this->UrbanFarmingModel->getAll();

        $data = array(
            'title' => 'Lahan | Tandur',
            'urbanfarmings' => $urbanfarmings
        );

        $this->template->view('admin/urban_farming/VUrbanFarming', $data);
    }
    public function verif(){
        $param = $_POST;
        
        $param['ISVERIF_URBAN']      = "1";
        $param['TGLVERIF_URBAN']     = date('Y-m-d');
        $param['updated_at']         = date('Y-m-d H:i:s');
        $this->UrbanFarmingModel->update($param);

        redirect('urban-farming');
    }
    public function unverif(){
        $param = $_POST;
        
        $param['ISVERIF_URBAN']     = "2";
        $param['TGLVERIF_URBAN']    = date('Y-m-d');
        $param['updated_at']        = date('Y-m-d H:i:s');
        $this->UrbanFarmingModel->update($param);

        redirect('urban-farming');
    }
}