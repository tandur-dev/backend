<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Master extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function provinsi_get(){
        $this->response(['status' => true, 'message' => 'Sukses'], 200);
    }

}