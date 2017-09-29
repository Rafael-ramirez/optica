<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
}

class Admin_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->login){
            redirect(base_url().'Login');
        }
    }
}
