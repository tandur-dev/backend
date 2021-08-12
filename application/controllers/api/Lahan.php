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

}