<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;

class Membresia extends BaseController{

    public function acl() {
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);

        return $data;
    }

    public function index(){

        $data = $this->acl();
        
        if ($data['logged_in'] == 1) {

            $data['membresias'] = $this->membresiasModel->_getMembresias();

            //Actualizo el status de las membresías

            $this->membresiasModel->_update_status_all($data['membresias']);
            $this->membresiasModel->_update_cantidad_usos_membresia($data['membresias']);
    
            //echo '<pre>'.var_export($data['membresias'], true).'</pre>';exit;
            //$data['version'] = $this->version;

            $data['title']='Membresías';
            $data['subtitle']='Lista de membresías';
            $data['main_content']='membresias/membresias_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function edit($idmembresias){
        
        $data = $this->acl();
        
        if ($data['logged_in'] == 1) {
            
            $data['membresia'] = $this->membresiasModel->_getMembresia($idmembresias);
            $data['paquetes'] = $this->paquetesModel->findAll();
            //echo '<pre>'.var_export($data['membresia'], true).'</pre>';exit;

            $data['title']='Membresías';
            $data['subtitle']='Edición de membresías';
            $data['main_content']='membresias/frm_edit_membresias_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    /**
     * Actualiza la fecha final de una membresía
     */

     public function update_date(){
        
        $data = [
            'fecha_final' => $this->request->getPostGet('fecha_final'),
            'idmembresias' => $this->request->getPostGet('idmembresias'),
            'idmiembros' => $this->request->getPostGet('idmiembros'),
            'observacion' => $this->request->getPostGet('observacion'),
            'idtipomovimiento' => $this->request->getPostGet('idtipomovimiento'),
            'idusuarios' => $this->session->idusuario
        ];

        //$fecha_inicio = Time::parse($data['fecha_inicio']);
        $fecha_final  = Time::parse($data['fecha_final']);

        //$diff = $fecha_inicio->difference($fecha_final);
        //$data['total']= date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days")); 
        
        // echo '<pre>'.var_export($data, true).'</pre>';exit;
        $lastQuery = $this->membresiasModel->_update_fecha_final_membresia($data);
        
        return redirect()->to('membresias');
        
     }

     /**
      * Form para seleccionar la membresía que se desea transferir
      */
     public function frm_select_transfer(){

        $data = $this->acl();
        
        if ($data['logged_in'] == 1) {

            $data['membresias'] = $this->membresiasModel->_getMembresias();
            $this->membresiasModel->_update_status_all($data['membresias']);

            //echo '<pre>'.var_export($data['membresias'], true).'</pre>';
            $data['title']='Membresías';
            $data['subtitle']='Tranferir membresías';
            $data['main_content']='membresias/transfer_membresias_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
     }

     /**
      * Frm para selecccionar el miembro al que se le desea transferir la membresía
      */
      public function fr_select_member_transfer_membership($idmembresias){

        $data = $this->acl();
        
        if ($data['logged_in'] == 1) {
            
            $data['membresia'] = $this->membresiasModel->_getMembresia($idmembresias);
            $data['miembrosList'] = $this->miembrosModel->_getMiembros();
            //echo '<pre>'.var_export($data['miembros'], true).'</pre>';
            $data['title']='Membresías';
            $data['subtitle']='Transferir membresía';
            $data['main_content']='membresias/frm_transfiere_membresia';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
        
     }

     /**
      * Transfiere le membresía al usuario
      */
      public function transfer_membership(){

        $id = $this->request->getPostGet('idmembresias');

        $data = [
            'idmiembros' => $this->request->getPostGet('idmiembros'),
            'observacion' => $this->request->getPostGet('observacion'),
            'idtipomovimiento' => 1, //TRANSFERENCIA
            'idusuario' => $this->session->idusuario
        ];

        $this->validation->setRuleGroup('transfiere_membresia');

        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{

            //PABLO Aquí se debería guardar un historial de la transferencia

            //Transfiere la membresía
            $result = $this->membresiasModel->update($id, $data);
            if ($result == NULL) {
                echo $lastQuery;
            }else{
                return redirect()->to('membresias');
            }
        }
    }

    public function grid_asigna_membresia(){

        $data = $this->acl();
        
        if ($data['logged_in'] == 1) {
            
            $data['miembrosList'] = $this->miembrosModel->_getMiembros();
            //$data['lastQuery'] = $this->db->getLastQuery();

            $data['title']='Membresías';
            $data['subtitle']='Asignar una membresía a un miembro';
            $data['main_content']='membresias/grid_asigna_membresia';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function asigna_membresia_miembro($idmiembros){
        
        $data = $this->acl();
        
        if ($data['logged_in'] == 1) {
            
            $data['paquetes'] = $this->paquetesModel->find();
            $data['datos'] = $this->miembrosModel->find($idmiembros);
            //$data['lastQuery'] = $this->db->getLastQuery();

            $data['title']='Membresías';
            $data['subtitle']='Asignar una membresía a un miembro';
            $data['main_content']='membresias/asigna_membresia_miembro';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function asign_membresia(){   
        
        $dias_asistencia = '';

        $lunes = $this->request->getPostGet('lunes');
        $martes = $this->request->getPostGet('martes');
        $miercoles = $this->request->getPostGet('miercoles');
        $jueves = $this->request->getPostGet('jueves');
        $viernes = $this->request->getPostGet('viernes');
        $sabado = $this->request->getPostGet('sabado');
        $domingo = $this->request->getPostGet('domingo');

        if ($lunes) {
            $dias_asistencia .= $lunes.',';
        } 
        if ($martes) {
            $dias_asistencia .= $martes.',';
        }
        if ($miercoles) {
            $dias_asistencia .= $miercoles.',';
        }
        if ($jueves) {
            $dias_asistencia .= $jueves.',';
        }
        if ($viernes) {
            $dias_asistencia .= $viernes.',';
        }
        if ($sabado) {
            $dias_asistencia .= $sabado.',';
        }
        if ($domingo) {
            $dias_asistencia .= $domingo.',';
        }
        
        
        $data = [
            'idpaquete' => $this->request->getPostGet('idpaquete'),
            'idmiembros' => $this->request->getPostGet('idmiembros'),
            'observacion' => $this->request->getPostGet('observacion'),
            'dias_asistencia' => $dias_asistencia
        ];


        //echo '<pre>'.var_export($data, true).'</pre>';exit;
        $this->validation->setRuleGroup('asigna_membresia');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{
       
            //object
            $paquete = $this->paquetesModel->find($data['idpaquete']);

            if ($data['idpaquete'] != 0 && $data['idpaquete'] != '0') {
                $fecha_inicio = date("Y-m-d"); 
                if($paquete->idcategoria == 3){

                }
                $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days"));
                $membresia = [
                    'idpaquete' => $data['idpaquete'],
                    'idmiembros' => $data['idmiembros'],
                    'fecha_inicio' => date("Y-m-d"),
                    'fecha_final' => $fecha_final,
                    'asistencias' => $paquete->entradas,  
                    'dias_asistencia' => $data['dias_asistencia'],
                    'observacion' => $data['observacion'],
                    'status' => 1
                ];
                
                $this->membresiasModel->insert($membresia);

                $idmembresias = $this->db->insertID();
                //echo '<pre>'.var_export($data, true).'</pre>';
                if ($idmembresias) {
                    $movimiento = [
                        'idmembresias' => $idmembresias,
                        'idmiembros' => $this->request->getPostGet('idmiembros'),
                        'observacion' => $this->request->getPostGet('observacion'),
                        'idtipomovimiento' => 1, //TRANSFERENCIA
                        'idusuarios' => $this->session->idusuario
                    ];

                    $this->movimientoModel->_insert_movimiento($movimiento);
                }
            }
            return redirect()->to('membresias');
        }
    }

    public function actualizarFechaInicioMembresia(){
        $id = $this->request->getPostGet('id');
        $fecha = $this->request->getPostGet('fechaInicio');
        $fecha_inicio = date("Y-m-d", strtotime($fecha));
        $obj = [
            'fecha_inicio' => $fecha_inicio
        ];

        $data['res'] = $this->membresiasModel->update($id, $obj);
        //echo $this->db->getLastQuery();
        echo json_encode($data);
    }

    public function actualizarFechaFinalMembresia(){
        $id = $this->request->getPostGet('id');
        $fecha = $this->request->getPostGet('fechaFinal');
        $fecha_final = date("Y-m-d", strtotime($fecha));
        $obj = [
            'fecha_final' => $fecha_final
        ];

        $data['res'] = $this->membresiasModel->update($id, $obj);
        //echo $this->db->getLastQuery();
        echo json_encode($data);
    }
}
