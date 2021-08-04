<?php
namespace App\Models;

use CodeIgniter\Database\BaseBuilder;


class Medida{

    protected $db;
    public function __construct(){
        $this->db = db_connect();
    }

    public function get_medidas(){
        $builder = $this->db->table("unidad_medida");
        $query = $builder->get()->getResultArray();;
        return $query;
    }

    

}