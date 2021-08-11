<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class User extends RestController{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('upload', 'image_lib'));
    }

    public function login_post()
    {
        $param = $this->post();
        if (!empty($param['username']) && !empty($param['password'])) {
            $user = $this->db->get_where('pengguna', ['NAMA_PENGGUNA' => $param['username']])->result();
            if ($user != null) {
                $resLogin = $this->db->get_where(
                    'pengguna',
                    ['NAMA_PENGGUNA' => $param['username'], 'PASSWORD_PENGGUNA' => $param['password']]
                )->result();
                if ($resLogin != null) {
                    $this->response(['status' => true, 'message' => 'Data berhasil ditemukan' , 'data' => $resLogin[0]], 200);
                }else{
                    $this->response(['status' => false, 'message' => 'Username atau password salah' ], 200);
                }
            } else {
                $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);
            }
        } else {
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
	
	public function register_post(){
        $param = $this->post();        
        if(!empty($param['email']) && !empty($param['namaLengkap']) && !empty($param['telepon']) && !empty($param['alamat']) && !empty($param['kecamatan']) && !empty($param['kelurahan']) && !empty($param['kabkot']) && !empty($param['provinsi']) && !empty($param['token'])){
			$this->form_validation->set_rules('email', 'Email','is_unique[user.EMAIL_USER]');
			
			if($this->form_validation->run()==TRUE){
			$fileKtp 	= $this->upload_fotoKTP($param['email']);
			$fileSelfie = $this->upload_fotoSelfie($param['email']);
			$fileProfil = $this->upload_fotoProfil($param['email']);
                
            $storeUser['EMAIL_USER']    = $param['email'];
            $storeUser['NAMA_USER']    	= $param['namaLengkap'];
            $storeUser['TELP_USER']    	= $param['telepon'];
            $storeUser['ALAMAT_USER']  	= $param['alamat'];
            $storeUser['ID_KECAMATAN']	= $param['kecamatan'];
            $storeUser['ID_KELURAHAN']	= $param['kelurahan'];
            $storeUser['ID_KOTA']   	= $param['kabkot'];
            $storeUser['ID_PROVINSI'] 	= $param['provinsi'];			
            $storeUser['TOKEN_USER']   	= $param['token'];
            $storeUser['FOTOKTP_USER'] 	= $fileKtp;
            $storeUser['SELFIE_USER'] 	= $fileSelfie;
            $storeUser['FOTO_USER'] 	= $fileProfil;

            $this->db->insert('user', $storeUser);
			
			$storeUser['ISVERIF_USER'] 	= "0";
			
            $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan', 'data' => $storeUser], 200);   
			}else{
				$this->response(['status' => false, 'message' => 'Email telah digunakan'], 200);
			}			
        }else{
			$this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);         
		}
    }
	
	function upload_fotoKTP($email){
        $newPath = './uploads/user/'.$email.'/';
        if(!is_dir($newPath)){
            mkdir($newPath, 0777, TRUE);
        }
        $config['upload_path'] = $newPath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE;
 
        $this->upload->initialize($config);
        if(!empty($_FILES['fotoKTP']['name'])){
 
            if ($this->upload->do_upload('fotoKTP')){
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

                return base_url('/uploads/user/'.$email.'/'.$gambar);
            }                      
        }else{
            return base_url('uploads/default.png');
        }
    }
	
	function upload_fotoSelfie($email){
        $newPath = './uploads/user/'.$email.'/';
        if(!is_dir($newPath)){
            mkdir($newPath, 0777, TRUE);
        }
        $config['upload_path'] = $newPath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE;
 
        $this->upload->initialize($config);
        if(!empty($_FILES['fotoSelfie']['name'])){
 
            if ($this->upload->do_upload('fotoSelfie')){
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

                return base_url('/uploads/user/'.$email.'/'.$gambar);
            }                      
        }else{
            return base_url('uploads/default.png');
        }
    }
	
	function upload_fotoProfil($email){
        $newPath = './uploads/user/'.$email.'/';
        if(!is_dir($newPath)){
            mkdir($newPath, 0777, TRUE);
        }
        $config['upload_path'] = $newPath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE;
 
        $this->upload->initialize($config);
        if(!empty($_FILES['fotoProfil']['name'])){
 
            if ($this->upload->do_upload('fotoProfil')){
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

                return base_url('/uploads/user/'.$email.'/'.$gambar);
            }                      
        }else{
            return base_url('uploads/default.png');
        }
    }
}