<?php
class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view('VLogin');
    }

    public function auth_admin()
    {
        $username = $this->input->post('username');
        $pass = $this->input->post('password');

        if ($username === "admin" && $pass === "admin") {
            $session = array(
                'who' => "admin",
                'isLogin' => true
            );
            $this->session->set_userdata($session);

            redirect('DashboardController');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Username / password salah! </div>');
            redirect('login');
        }
    }
}
