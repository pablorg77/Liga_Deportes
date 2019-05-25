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

    function getEncuentrosPorEquipo($idEquipo){

        $query=$this->db
        ->select('*')
        ->from('equipos')
        ->where('idequipos', $idEquipo)
        ->get();
        $equipo = $query->row();
        if($equipo!=null){
            $getQuery=$this->db
                ->select('*')
                ->from('encuentros')
                ->where('local = "'.$equipo->nombre.'" OR visitante = "'.$equipo->nombre.'"')
                ->get();
            return $getQuery->result_array();
        }
        else{
            return null;
        }
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