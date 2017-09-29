
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_Landing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
	public function index()
	{
    $data = array (
        'csrf' => array(
            'name' => $this->security->get_csrf_token_name(),       // Token de seguridad
            'hash' => $this->security->get_csrf_hash()
        )
    );
		$this->load->view('landing', $data);
	}

  public function registro()
	{
    $data = array (
        'csrf' => array(
            'name' => $this->security->get_csrf_token_name(),       // Token de seguridad
            'hash' => $this->security->get_csrf_hash()
        )
    );
		$this->load->view('registro', $data);
	}
}
