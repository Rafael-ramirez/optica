<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Este modelo usa Eloquent, no usa la interfaz de modelos de Codeigniter CI_Model

use Illuminate\Database\Eloquent\Model as Eloquent;

class Usuarios extends Eloquent{
    // Asignaciones -------------------------------------------------------
    // definir que atributos son asignables (por seguridad)
    // Ligar el modelo a la tabla ---------------------------------
    // Definir la tabla yel campo llave de la misma
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    // Definir relaciones --------------------------------------------------
    public function Archivos()
    {
        return $this->hasMany("Archivos", "id_usuario");
    }
}
