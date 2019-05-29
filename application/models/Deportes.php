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

    function getEquipoByid($id){
        $query=$this->db
            ->select('*')
            ->from('equipos')
            ->where('idequipos', $id)
            ->get();
        return $query->row();
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

    function getEquiposByUsuarioId(){
        $arrEquipos = [];

        if($this->Usuario->isLogged()){
            $query=$this->db
            ->select('equipos_idequipos')
            ->from('usuario_en_equipo')
            ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
            ->where('notificacion', 0)
            ->get();
        $equiposId = $query->result_array();
            if($equiposId!=null){
                
                foreach($equiposId as $id){
                    $queryEq=$this->db
                    ->select('*')
                    ->from('equipos')
                    ->where('idequipos', $id['equipos_idequipos'])
                    ->get();
                    $arrEquipos = $queryEq->result_array();
                }
                return $arrEquipos;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }

    function checkIfInTeam($equipoId){

        if($this->Usuario->isLogged()){
        $query=$this->db
        ->select('*')
        ->from('usuario_en_equipo')
        ->where('equipos_idequipos', $equipoId)
        ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
        ->get();

            if($query->result_array()!=null){
                return true;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }

    function setNotify($equipoId){
        $this->db
        ->set('notificacion', 1)
        ->where('equipos_idequipos', $equipoId)
        ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
        ->update('usuario_en_equipo');
    }

}
