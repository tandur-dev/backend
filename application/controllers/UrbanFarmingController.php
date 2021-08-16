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
        $this->load->library('notification');
        $this->load->model('UrbanFarmingModel');
        $this->load->model('UserModel');
        if (empty($this->session->userdata('user_logged')) || $this->session->userdata('user_logged') != 'admin') {
			redirect('login');
		};
    }

    public function index()
    {
        $urbanfarmings = $this->UrbanFarmingModel->getAll();

        $data = array(
            'title' => 'Urban Farming | Tandur',
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

        $user = $this->UserModel->getToken(['filter' => ['EMAIL_USER' => $param['EMAIL_USER']]]);
        $notif['regisIds']  = $user;
        $notif['title']     = "Info Pengajuan Urban Farming";
        $notif['message']   = "Pengajuan Urban Farming ".$param['ID_URBAN']." Telah Disetujui";
        $this->notification->push($notif);

        redirect('urban-farming');
    }
    public function unverif(){
        $param = $_POST;
        
        $param['ISVERIF_URBAN']     = "2";
        $param['TGLVERIF_URBAN']    = date('Y-m-d');
        $param['updated_at']        = date('Y-m-d H:i:s');
        $this->UrbanFarmingModel->update($param);

        $user = $this->UserModel->getToken(['filter' => ['EMAIL_USER' => $param['EMAIL_USER']]]);
        $notif['regisIds']  = $user;
        $notif['title']     = "Info Pengajuan Urban Farming";
        $notif['message']   = "Pengajuan Urban Farming ".$param['ID_URBAN']." Ditolak";
        $this->notification->push($notif);

        redirect('urban-farming');
    }
}