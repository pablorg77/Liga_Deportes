<?php

class Deportes extends CI_Model{

    function getCategorias(){
        $query=$this->db
            ->select('*')
            ->from('categorias')
            ->get();
        return $query->result_array();
    }

    function getDeportes(){
        $query=$this->db
            ->select('*')
            ->from('deportes')
            ->get();
        return $query->result_array();
    }

    function getEncuentros(){
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->get();
        return $query->result_array();
    }

    function getDeportesByCategoria($id){
        $query=$this->db
            ->select('*')
            ->from('deportes')
            ->where('idcategorias', $id)
            ->get();
        return $query->result_array();
    }

    function getDeporteById($id){
        $query=$this->db
            ->select('*')
            ->from('deportes')
            ->where('iddeporte', $id)
            ->get();
        return $query->row();
    }

    function getEquiposByDeporteId($id){
        $query=$this->db
            ->select('*')
            ->from('equipos')
            ->where('deportes_iddeporte', $id)
            ->get();
        return $query->result_array();

    }

    function getEncuentrosByDeporteId($id){

        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->where('deportes_iddeporte', $id)
            ->get();
        return $query->result_array();

    }

    function getEncuentrosByLigaId($id){
        
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->where('liga_idliga', $id)
            ->get();
        return $query->result_array();

    }

}
