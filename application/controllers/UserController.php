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
        $this->load->library('notification');
        $this->load->model('UserModel');
    }

    public function index()
    {
        $users = $this->UserModel->getAll();

        $data = array(
            'title' => 'User | Tandur',
            'users' => $users
        );

        $this->template->view('admin/user/VUser', $data);
    }
    public function verif(){
        $param = $_POST;
        
        $param['ISVERIF_USER']      = "1";
        $param['TGLVERIF_USER']     = date('Y-m-d');
        $param['updated_at']        = date('Y-m-d H:i:s');
        $this->UserModel->update($param);

        $user = $this->UserModel->getToken(['filter' => ['EMAIL_USER' => $param['EMAIL_USER']]]);
        $notif['regisIds']  = $user;
        $notif['title']     = "Info Akun";
        $notif['message']   = "Selamat akun anda telah diverifikasi";
        $this->notification->push($notif);        

        redirect('user');
    }
    public function unverif(){
        $param = $_POST;
        
        $param['ISVERIF_USER']      = "2";
        $param['TGLVERIF_USER']     = date('Y-m-d');
        $param['updated_at']        = date('Y-m-d H:i:s');
        $this->UserModel->update($param);

        $user = $this->UserModel->getToken(['filter' => ['EMAIL_USER' => $param['EMAIL_USER']]]);
        $notif['regisIds']  = $user;
        $notif['title']     = "Info Akun";
        $notif['message']   = "Maaf akun anda telah ditolak";
        $this->notification->push($notif);        

        redirect('user');
    }
}