<?php

namespace App\Controllers;

class Home extends BaseController {

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        $data['version'] = $this->version;

        return $data;
    }
    
    public function index(): string {

        $data['title']='Lista de membresías';
        $data['main_content']='membresias/membresias_view';
        //return view('includes/template', $data);
        return view('home/inicio_view');
    }
}
