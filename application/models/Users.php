<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Este modelo usa Eloquent, no usa la interfaz de modelos de Codeigniter CI_Model

use Illuminate\Database\Eloquent\Model as Eloquent;

class Users extends Eloquent{
    // Asignaciones -------------------------------------------------------
    // definir que atributos son asignables (por seguridad)
    // Ligar el modelo a la tabla ---------------------------------
    // Definir la tabla yel campo llave de la misma
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    // Definir relaciones --------------------------------------------------
    public function Empresas()
    {
        return $this->hasOne("Empresas", "user_id");
    }
}
