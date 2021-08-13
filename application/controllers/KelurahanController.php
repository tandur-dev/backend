<?php
class KelurahanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('table');
        $this->load->library('upload');
        $this->load->model('MasterModel');
    }

    public function index()
    {
        $kelurahan = $this->MasterModel->getAll(['table' => 'md_kelurahan']);

        $data = array(
            'title' => 'Kelurahan | Tandur',
            'kelurahan' => $kelurahan
        );

        $this->template->view('admin/master_data/VKelurahan', $data);
    }

    public function tambahProvinsi()
    {   
        $jeniskamar = $this->MKamar->getJenisKamar();
        $data = array(
            'title' => 'Kamar | Hotel Biety',
            'jenisKamar' => $jeniskamar
        );
        $this->template->view('Kamar/VTambahKamar', $data);
    }

    public function aksiTambahProvinsi(){

        $data = $_POST;
        $data['KETERSEDIAAN_KAMAR'] = 1;

        $this->MKamar->saveKamar($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kamar berhasil ditambahkan! </div>');

        redirect('Kamar');
    }

    public function editProvinsi($idProvinsi)
    {
        $dataKamar = $this->MKamar->getSelectKamar($idProvinsi);
        $jeniskamar = $this->MKamar->getJenisKamar();
        $data = array(
            'title' => 'Kamar | Hotel Biety',
            'kamar' => $dataKamar,
            'jenisKamar' => $jeniskamar
        );

        $this->template->view('kamar/VEditKamar', $data);
    }

    public function aksiEditProvinsi()
    {         
        $data = $_POST;
        $this->MKamar->updateKamar($data);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kamar berhasil diperbarui! </div>');

        redirect('Kamar');
    } 

    public function aksiHapusProvinsi($idProvinsi)
    {         
        $this->MKamar->deleteKamar($idKamar);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kamar berhasil dihapus! </div>');

        redirect('Kamar');
    } 
}