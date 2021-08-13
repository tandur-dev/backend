<?php
class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
    {      
        $data = array(
            'title' => 'Dashboard | Tandur',
        );

        $this->template->view('admin/VDashboard', $data);
    }
}