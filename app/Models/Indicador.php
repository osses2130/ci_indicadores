<?php
namespace App\Models;

use CodeIgniter\Database\BaseBuilder;


class Indicador{

    protected $db;
    public function __construct(){
        $this->db = db_connect();
    }


    public function get_indicador_medida(){
        $builder = $this->db->table("indicadores");
        $builder->select("indicadores.*,unidad_medida.nombre as nombre_medida");
        $builder->join("unidad_medida","unidad_medida.id=id_unidad_medida");
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function set_inserta_datos($data){
        $builder = $this->db->table("indicadores");
        if($builder->insert($data)){
            return 1;
        }else{
            return 0;
        }
    }

    public function set_actualiza_datos($id,$data){
        $builder = $this->db->table("indicadores");
        $builder->where('id', $id);
        if($builder->update($data)){
            return 1;
        }else{
            return 0;
        }
    }

    public function set_elimina_datos($id){
        $builder = $this->db->table("indicadores");
        $builder->where('id', $id);
        if($builder->delete()){
            return 1;
        }else{
            return 0;
        }
    }

}