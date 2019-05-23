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

    function getEncuentrosPorLiga($idliga){
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->where('liga_idliga', $idliga)
            ->get();
        return $query->result_array();
    }

}