<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model{
    protected $table      = 'asistencia';
    protected $primaryKey = 'idasistencia';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'idmembresias', 'num_asistencias', 'codigos_multipases'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    private function _get_last_attend($idmembresias){
        $last = $this->builder->where('idmembresias', $idmembresias)->orderBy('idasistencia', 'DESC')->limit(1);
        echo $last;
    }

    public function _get_all_attend($idmembresias){
        $result = null;
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->select('idasistencia');
        $builder->where('idmembresias', $idmembresias);
        $query = $builder->get();
        foreach ($query->getResult() as $row) {
            $result[] = $row;
        }
     
        return $result;
    }   
    
    public function _insert_asistencia($data){
        $this->db->transStart();
        $builder = $this->db->table('asistencia');
        $builder->set('idmembresias', $data['idmembresias']);
        $builder->set('num_asistencias', $data['num_asistencias']);
        $builder->set('codigos_multipases', $data['codigos_multipases']);
        $builder->insert();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return 0;
        }else{
            return 1;
        }
    }

    public function _getSumaAsistencias($idmembresias){
        $result = null;
        $builder = $this->db->table('asistencia');
        $builder->selectSum('num_asistencias', 'sumaAsistencias');
        $builder->where('idmembresias', $idmembresias);
        $query = $builder->get();
        foreach ($query->getResult() as $row) {
            $result = $row->sumaAsistencias;
        }
     
        return $result;
    }
}