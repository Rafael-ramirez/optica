<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_Users extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users');
        if($this->session->type != 1){
            redirect(base_url().'captura');
        }
    }
	public function index()
	{
    $data = array (
        'csrf' => array(
            'name' => $this->security->get_csrf_token_name(),       // Token de seguridad
            'hash' => $this->security->get_csrf_hash()
        )
    );
    $data['users'] = Users::all();
		$this->load->view('users', $data);
	}

	public function userAdd()
    {
        $post = $this->input->post(NULL, TRUE);
        $name = $post['nombre'];
        $apellido = $post['apellido'];
        $usuario = $post['usuario'];
        $pass = md5($post['pass']);
        $tipo = $post['tipo'];

        $users = new Users();
        $users->name = $name;
        $users->lastname = $apellido;
        $users->user = $usuario;
        $users->pass = $pass;
        $users->type = $tipo;
        $users->save();

        $data['user_id'] = $users->user_id;
        $data['fecha'] = date('Y/m/d', time());
        $data['name'] = $name.' '.$apellido;
        $data['user'] = $usuario;
        $data['tipo'] = $tipo == 1 ? 'Administrador' : 'Capturista';
        $data['hash'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function userGet()
    {
        $post = $this->input->get(NULL, TRUE);
        $id = $post['user_id'];

        $user = Users::find($id);

        $data['user'] = $user;
        echo json_encode($data);
    }

    public function userUpdate()
    {
        $post = $this->input->post(NULL, TRUE);
        $id = $post['user_id'];
        $nombre = $post['nombre'];
        $apellido = $post['apellido'];
        $usuario = $post['usuario'];
        $pass = $post['pass'];
        $tipo = $post['tipo'];

        $user = Users::find($id);
        $user->name = $nombre;
        $user->lastname = $apellido;
        $user->user = $usuario;
        if($post['pass'] != ''):
            $user->pass = md5($pass);
        endif;
        $user->type = $tipo;
        $user->save();

        $data['user_id'] = $id;
        $data['fecha'] = date('Y/m/d', strtotime($user->created_at));
        $data['name'] = $nombre.' '.$apellido;
        $data['user'] = $usuario;
        $data['tipo'] = $tipo == 1 ? 'Administrador' : 'Capturista';
        $data['hash'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function userDelete()
    {
        $post = $this->input->post(NULL, TRUE);
        $id = $post['user_id'];

        $user = Users::find($id);
        $user->delete();

        $data['hash'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    
    //------------------------------------------------------------------------------------------------------------------
    private function _pdf_create_folder() {
      if (!is_dir("./archivos")) {
          mkdir("./archivos/");
          mkdir("./archivos/pdf");
      }
  }

  //------------------------------------------------------------------------------------------------------------------
    private function _pdf_show($filename) {
      if (is_dir("./archivos/pdf")) {
          $route = base_url("archivos/pdf/" . $filename);
          if (file_exists("./archivos/pdf/" . $filename)) {
              header('Content-type: application/pdf');
              readfile($route);
              unlink("./archivos/pdf/" . $filename);
          }
      }
  }
}
