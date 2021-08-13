<?php
class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('table');
        $this->load->library('upload');
        $this->load->model('UserModel');
    }

    public function index()
    {
        $user = $this->UserModel->getAll();

        $data = array(
            'title' => 'User | Tandur',
            'user' => $user
        );

        $this->template->view('admin/user/VUser', $data);
    }    
}