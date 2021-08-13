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
        $urbanfarming = $this->UrbanFarmingModel->getAll();

        $data = array(
            'title' => 'Lahan | Tandur',
            'urbanfarming' => $urbanfarming
        );

        $this->template->view('admin/urban_farming/VUrbanFarming', $data);
    }    
}