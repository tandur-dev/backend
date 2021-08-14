<?php
class KecamatanController extends CI_Controller
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
        $kecamatan = $this->MasterModel->getAll(['table' => 'md_kecamatan']);

        $data = array(
            'title' => 'Kecamatan | Tandur',
            'kecamatan' => $kecamatan
        );

        $this->template->view('admin/master_data/VKecamatan', $data);
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
    public function ajxGetData(){
        $draw   = $_POST['draw'];
        $offset = $_POST['start'];
        $limit  = $_POST['length']; // Rows display per page
        
        $kecamatan = $this->MasterModel->getDataTable(['offset' => $offset, 'limit' => $limit, 'table' => 'md_kecamatan']);
        $datas = array();
        foreach ($kecamatan['records'] as $item) {
            $datas[] = array( 
                "idKecamatan" => $item->ID_KECAMATAN,
                "nama"        => $item->NAMA_KECAMATAN,
                "aksi"        => '
                    <div class="btn-group" role="group">
                        <button type="button" data-toggle="modal" data-id="" data-target="#mdlFoto" class="btn btn-dark btn-sm rounded mdlFoto" data-tooltip="tooltip" data-placement="top" title="Foto">
                            <i class="fas fa-edit"></i>
                        </button>&nbsp;
                        <button type="button" data-toggle="modal" data-id="" data-name="" data-target="#mdlGallery" class="btn btn-dark btn-sm rounded mdlGallery" data-tooltip="tooltip" data-placement="top" title="Gallery">
                            <i class="fas fa-trash"></i>
                        </button>&nbsp;
                    </div>
                '
            );
        }

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $kecamatan['totalRecords'],
            "recordsFiltered" => $kecamatan['totalRecords'],
            "aaData" => $datas
        );

        echo json_encode($response);
    }
}