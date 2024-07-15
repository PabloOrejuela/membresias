<?php

namespace App\Controllers;

class Paquetes extends BaseController{

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        $data['version'] = $this->version;

        return $data;
    }

    protected $tipo_paquete = [
        '1' => 'normal',
        '2' => 'multipase'
    ];


    public function getPaquete($idpaquetes){

        $data['paquete'] = $this->paquetesModel->find($idpaquetes);
        //echo '<pre>'.var_export($data['miembros'], true).'</pre>';

        return $data;
    }
}
