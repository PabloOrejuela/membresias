<?php

namespace App\Controllers;

class Asistencia extends BaseController{

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);

        return $data;
    }

    
    /**
     * undocumented function summary
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function insert(){
        
        //Insertar asistencia de la membresía en asistencia
        $data = [
            'idmembresias' => $this->request->getPostGet('idmembresias'),
            'num_asistencias' => $this->request->getPostGet('num_asistencias'),
            'codigos_multipases' => $this->request->getPostGet('codigos_multipases')
        ];

        //echo '<pre>'.var_export($data, true).'</pre>';
        
        $this->asistenciaModel->_insert_asistencia($data);
        //$this->membresiasModel->_update_status_all($data['membresias']);
        
        return redirect()->to('exitoAsistencia');
    }

    public function exitoAsistencia(){
        
        $data = $this->acl();
        
        if ($data['logged_in'] == 1) {

            $data['title']='Registra asistencia';
            $data['main_content']='asistencias/exito_asistencia_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function FrmRegistraAsistenciaInstructor(){

        $data = $this->acl();

        $data['instructores'] = $this->usuarioModel->_getUsuarioInstructor();
        //echo '<pre>'.var_export($data['instructores'], true).'</pre>';exit;
        if ($data['logged_in'] == 1) {

            $data['title']='Registra asistencia Instructor';
            $data['main_content']='asistencias/registra_asistencia_instructor_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }

    }

    public function registraAsistenciaInstructor(){

        $num_documento = $this->request->getPostGet('num_documento');
        $id = $this->request->getPostGet('nombre');

        $data = [
            'num_documento' => $num_documento,
            'idusuario' => $id,
            'fechaClase' => date('Y-m-d H:m:s'),
            'observaciones' => $this->request->getPostGet('observaciones')
        ];

        $this->validation->setRuleGroup('asistenciaInstructor');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{ 
            
            $resp = $this->asistenciaInstructorModel->insert($data);
            
            if ($resp) {

                $data['nombre'] = $this->session->nombre;
                $data['instructor'] = $this->session->instructor;
                $data['miembros'] = $this->session->miembros;
                $data['admin'] = $this->session->admin;

                $this->session->setFlashdata('mensaje', $data);
                //$this->logout();
                return redirect()->back()->with(
                    'mensaje', 
                    'exito');

                //return redirect()->to('registra-asistencia-instructor');
            }else{
                $this->session->setFlashdata('mensaje', $data);
                //$this->logout();
                return redirect()->back()->with(
                    'mensaje', 
                    'error');

                return redirect()->to('/');
            }
        }     
    }

    public function getInstructor(){
        $id = $this->request->getPostGet('id');
        $instructor = $this->usuarioModel->_getDataInstructor($id);
        echo json_encode($instructor);
    }
}
