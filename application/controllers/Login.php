<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users');
        $this->load->model('Empresas');
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
		$this->load->view('index', $data);
	}

	public function CheckLogin()
    {
        $post = $this->input->post(NULL, TRUE);
        $user = $post['user'];
        $pass = $post['password'];
        $loginArray = array('correo'=> $user, 'pass' => md5($pass));
        $login = Users::with('Empresas')->where($loginArray)->first();
        // var_dump($login->empresas->nombre); die();
        if($login)
        {
            $session_array = array(
                'user_id' => $login->user_id,
                'id_empresa' => $login->empresas->id_empresa,
                'empresa' => $login->empresas->nombre,
                'user' => $login->user,
                'correo' => $login->correo,
                'type' => $login->type,
                'login' => true
            );
            $this->session->set_userdata($session_array);
              redirect(base_url().'buscar_productos');
        }
        else {
            $this->session->set_flashdata('ERRNOLOGIN', 'Error: Usuario no existe o contraseña incorrecta');
            redirect(base_url().'Login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url().'Login');
    }
}
