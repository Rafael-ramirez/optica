<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users');
    }
	public function index()
	{
        $data = array (
            'csrf' => array(
                'name' => $this->security->get_csrf_token_name(),       // Token de seguridad
                'hash' => $this->security->get_csrf_hash()
            ),
            'ERRNOLOGIN' => $this->session->flashdata('ERRNOLOGIN') !== NULL    // Carga el error o false si no existe tal
                ? $this->session->flashdata('ERRNOLOGIN')
                : false
        );
		$this->load->view('inicio', $data);
	}
}
