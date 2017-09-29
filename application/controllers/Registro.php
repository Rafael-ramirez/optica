

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

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
		$this->load->view('registro', $data);
	}
  //------------------------------------------------------------------------------------------------------------------
  public function Agregar()
    {
        $post = $this->input->post(NULL, TRUE);

        // Datos de la empresa
        
        $empresa = $post['empresa'];
        $municipio = $post['municipio'];
        $estado = $post['estado'];
        $calle = $post['calle'];
        $numero = $post['numero'];
        $rfc = $post['rfc'];
        // $logo = $post['logo'];
        $sector = $post['sector'];

        // Datos del contacto
        $name = $post['nombre'];
        $correo = $post['correo'];
        $telefono = $post['telefono'];
        $extension = $post['extension'];
        $pass = md5($post['password']);

        //Se crea (agrega) la empresa a la tabla empresas
        $foto = $this->_upload_logo();
        $validarEmpresa = Empresas::where("nombre", $empresa)->first();
        if($validarEmpresa){
          $this->session->set_flashdata('ERRNOLOGIN', 'Error: Nombre de empresa ya existente');
          redirect("/registro");
        }

        $validarCorreo = Users::where("correo", $correo)->first();
        if($validarCorreo){
          $this->session->set_flashdata('ERRNOLOGIN', 'Error: Correo electronico ya registrado');
          redirect("/registro");
        }

        if($validarEmpresa){
          $this->session->set_flashdata('ERRNOLOGIN', 'Error: Nombre de empresa ya existente');
          redirect("/registro");
        }

        //Se crea (agrega) el usuario a la tabla usuarios
        $users = new Users();
        $users->name = $name;
        $users->correo = $correo;
        $users->pass = $pass;
        $users->extension = $extension;
        $users->telefono = $telefono;
        $users->save();

        if($foto !== false) {
          $empresas = new Empresas();
          $empresas->user_id =  $users->user_id;
          $empresas->nombre = $empresa;
          $empresas->municipio = $municipio;
          $empresas->estado = $estado;
          $empresas->calle = $calle;
          $empresas->numero = $numero;
          $empresas->rfc = $rfc;
          $empresas->logo = $foto;
          // $empresas->logo = $logo;
          $empresas->sector = $sector;
          $empresas->save();
      }

        redirect('/login');
        // $data['user_id'] = $users->user_id;
        // $data['fecha'] = date('Y/m/d', time());
        // $data['name'] = $name.' '.$apellido;
        // $data['user'] = $usuario;
        // $data['tipo'] = $tipo == 1 ? 'Administrador' : 'Capturista';
        // $data['hash'] = $this->security->get_csrf_hash();
        // echo json_encode($data);
    }

    //-----------------------------------------------Private Functions-----------------------------------------------------------------
    private function _upload_logo() {
        $config['upload_path']          = './archivos/img/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100000;
        $config['max_width']            = 3000;
        $config['max_height']           = 3000;
        $config["encrypt_name"]         = true;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logo'))
        {
            $error = array('error' => $this->upload->display_errors());

            //var_dump($error);
            //return false;
        }
        else
        {
            $data = $this->upload->data();
            return $data['file_name'];
        }
    }
    //------------------------------------------------------------------------------------------------------------------

}
