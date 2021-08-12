<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Lahan extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('LahanModel');
    }
    public function lahanDetail_get($id){
        $lahan = $this->LahanModel->get(['filter' => ['ID_LAHAN' => $id]]);

        if($lahan != null){
            $fasilitas = explode(';', $lahan[0]->FASILITAS_LAHAN);

            $lahan[0]->FASILITAS_LAHAN = array();
            $lahan[0]->FASILITAS_LAHAN['ISIRIGASI_LAHAN']     = $fasilitas[0];
            $lahan[0]->FASILITAS_LAHAN['ISLISTRIK_LAHAN']     = $fasilitas[2];
            $lahan[0]->FASILITAS_LAHAN['ISPERALATAN_LAHAN']   = $fasilitas[2];
            $lahan[0]->FASILITAS_LAHAN['ISKANOPI_LAHAN']      = $fasilitas[3];

            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $lahan[0]], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);        
        }
    }
    public function ulasan_get($idLahan){
        $param = $this->get();
        $ulasans = $this->LahanModel->getUlasan(['filter' => ['ID_LAHAN' => $idLahan, 'ISFINISHED_URBAN' => '1'], 'limit' => $param['limit']]);

        if($ulasans != null){
            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $ulasans], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);        
        }
    }
    public function terdekat_get(){
        $param = $this->get();
        $lahans = $this->LahanModel->getTerdekat($param);

        if($lahans != null){
            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $lahans], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);        
        }
    }
	
	public function sewakan_post()
    {
        $param = $this->post();
        if (!empty($param['email']) && !empty($param['namaLahan'])) {
			$idLahan    = str_shuffle(time());
                
            $storeLahan['ID_LAHAN']         = $idLahan;
            $storeLahan['EMAIL_USER']       = $param['email'];
            $storeLahan['NAMA_LAHAN']    	= $param['namaLahan'];
            $storeLahan['ALAMAT_LAHAN']    	= $param['alamat'];
            $storeLahan['ID_KELURAHAN']  	= $param['kelurahan'];
            $storeLahan['ID_KECAMATAN']  	= $param['kecamatan'];
            $storeLahan['ID_KOTA']	        = $param['kabkot'];
            $storeLahan['ID_PROVINSI']	    = $param['provinsi'];
            $storeLahan['LOKASI_LAHAN']   	= $param['lokasi'];
            $storeLahan['PEMILIK_LAHAN'] 	= $param['pemilik'];
            $storeLahan['HARGA_LAHAN']   	= $param['harga'];
            $storeLahan['NOKTP_LAHAN'] 	    = $param['noKTP'];
            $storeLahan['NOSERTAN_LAHAN'] 	= $param['noSertan'];
            $storeLahan['PANJANG_LAHAN'] 	= $param['panjang'];
            $storeLahan['LEBAR_LAHAN'] 	    = $param['lebar'];
            $storeLahan['PERATURAN_LAHAN'] 	= $param['peraturan'];
            $storeLahan['LATITUDE_LAHAN'] 	= $param['latitude'];
            $storeLahan['LONGITUDE_LAHAN'] 	= $param['longitude'];

            $arr = array(
                $param['fasilitas']['isIrigasi'],
                $param['fasilitas']['isListrik'],
                $param['fasilitas']['isPeralatan'],
                $param['fasilitas']['isKanopi']
            );
            $storeLahan['FASILITAS_LAHAN']  = implode(';',$arr);

			$this->LahanModel->insert($storeLahan);
			
            $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan', 'idLahan' => $idLahan], 200);
        } else {
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }

    public function foto_post()
    {
        $param = $this->post();
        if (!empty($param['idLahan'])) {
            $foto1 	    = $this->upload_fotoSatu($param['idLahan']);
			$foto2      = $this->upload_fotoDua($param['idLahan']);
                
            $storeLahan['ID_LAHAN']         = $param['idLahan'];           
            $storeLahan['FOTO1_LAHAN'] 	    = $foto1;
            $storeLahan['FOTO2_LAHAN'] 	    = $foto2;

			$this->LahanModel->update($storeLahan);
			
            $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan'], 200);
        } else {
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
       
	function upload_fotoSatu($email){
        $newPath = './uploads/lahan/'.$email.'/';
        if(!is_dir($newPath)){
            mkdir($newPath, 0777, TRUE);
        }
        $config['upload_path'] = $newPath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE;
 
        $this->upload->initialize($config);
        if(!empty($_FILES['foto1']['name'])){
 
            if ($this->upload->do_upload('foto1')){
                $gbr = $this->upload->data();
                $config['image_library']='gd2';
                $config['source_image']=$newPath.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= true;
                $config['width']= 600;
                $config['new_image']= $newPath.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
                $gambar=$gbr['file_name'];

                return base_url('/uploads/lahan/'.$email.'/'.$gambar);
            }                      
        }else{
            return base_url('uploads/default.png');
        }
    }

    function upload_fotoDua($email){
        $newPath = './uploads/lahan/'.$email.'/';
        if(!is_dir($newPath)){
            mkdir($newPath, 0777, TRUE);
        }
        $config['upload_path'] = $newPath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE;
 
        $this->upload->initialize($config);
        if(!empty($_FILES['foto2']['name'])){
 
            if ($this->upload->do_upload('foto2')){
                $gbr = $this->upload->data();
                $config['image_library']='gd2';
                $config['source_image']=$newPath.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= true;
                $config['width']= 600;
                $config['new_image']= $newPath.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
                $gambar=$gbr['file_name'];

                return base_url('/uploads/lahan/'.$email.'/'.$gambar);
            }                      
        }else{
            return base_url('uploads/default.png');
        }
    }
}