<?php
class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        if (empty($this->session->userdata('user_logged')) || $this->session->userdata('user_logged') != 'admin') {
			redirect('login');
		};
    }

    public function index()
    {      
        $data = array(
            'title' => 'Dashboard | Tandur',
        );

        $this->template->view('admin/VDashboard', $data);
    }
}