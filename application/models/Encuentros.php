<?php

class Encuentros extends CI_Model{

    function getAllEncuentros(){
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->get();
        return $query->result_array();
    }

    function getEncuentrosPorDeporteId($id){
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->where('deportes_iddeporte', $id)
            ->get();
        return $query->result_array();
    }

    function getEncuentrosPorEquipo($equipo){
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->where('local = "'.$equipo.'" OR visitante = "'.$equipo.'"')
            ->get();
        return $query->result_array();
    }

    function getEncuentrosRecientes(){
        $fecha=date('Y-m-d');
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->where('"'.$fecha.'" < fecha')
            ->get();
        return $query->result_array();
    }

    function getEncuentrosActuales(){
        $fecha=date('Y-m-d');
        $query=$this->db
            ->select('*')
            ->where('"'.$fecha.'" = fecha')
            ->get();
        return $query->result_array();
    }

    function getEncuentrosProximos(){
        $fecha=date('Y-m-d');
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->where('"'.$fecha.'" > fecha')
            ->get();
        return $query->result_array();

    }

}