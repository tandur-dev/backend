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
        $this->load->library('notification');
        $this->load->model('LahanModel');
        $this->load->model('UserModel');
        if (empty($this->session->userdata('user_logged')) || $this->session->userdata('user_logged') != 'admin') {
			redirect('login');
		};
    }

    public function index()
    {
        $lahans = $this->LahanModel->getAll();

        $data = array(
            'title' => 'Lahan | Tandur',
            'lahans' => $lahans
        );

        $this->template->view('admin/lahan/VLahan', $data);
    }    

    public function verif(){
        $param = $_POST;
        
        $param['ISVERIF_LAHAN']     = "1";
        $param['TGLVERIF_LAHAN']    = date('Y-m-d');
        $param['updated_at']        = date('Y-m-d H:i:s');
        $this->LahanModel->update($param);

        $user = $this->UserModel->getToken(['filter' => ['EMAIL_USER' => $param['EMAIL_USER']]]);
        $notif['regisIds']  = $user;
        $notif['title']     = "Info Pengajuan Lahan";
        $notif['message']   = "Pengajuan Lahan ".$param['ID_LAHAN']." Telah Disetujui";
        $this->notification->push($notif);

        redirect('lahan');
    }
    public function unverif(){
        $param = $_POST;
        
        $param['ISVERIF_LAHAN']     = "2";
        $param['TGLVERIF_LAHAN']    = date('Y-m-d');
        $param['updated_at']        = date('Y-m-d H:i:s');
        $this->LahanModel->update($param);

        $user = $this->UserModel->getToken(['filter' => ['EMAIL_USER' => $param['EMAIL_USER']]]);
        $notif['regisIds']  = $user;
        $notif['title']     = "Info Pengajuan Lahan";
        $notif['message']   = "Pengajuan Lahan ".$param['ID_LAHAN']." Ditolak";
        $this->notification->push($notif);

        redirect('lahan');
    }
}