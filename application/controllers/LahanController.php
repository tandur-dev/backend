<?php
class LahanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('table');
        $this->load->library('upload');
        $this->load->model('LahanModel');
    }

    public function index()
    {
        $lahan = $this->LahanModel->getAll();

        $data = array(
            'title' => 'Lahan | Tandur',
            'lahan' => $lahan
        );

        $this->template->view('admin/lahan/VLahan', $data);
    }    
}