<?php

class Leagues extends CI_Model{

    function getAllLigas(){
        $query=$this->db
            ->select('*')
            ->from('liga')
            ->get();
        return $query->result_array();
    }

    function getLigaFromId($id){
            $query=$this->db
                ->select('*')
                ->from('liga')
                ->where('idliga', $id)
                ->get();
            return $query->row();
    }

    function setLiga($data){

        if($data["visible"] == 'ko'){
            $this->db->query('INSERT INTO liga (deportes_iddeporte, nombre, descripcion, borrado, visible) 
            VALUES ("'.$data["deporte"].'","'.$data["nombre"].'","'.$data["descripcion"].'", "N", 0)');
        }
        else if($data["visible"] == 'ok'){
            $this->db->query('INSERT INTO liga (deportes_iddeporte, nombre, descripcion, borrado, visible) 
            VALUES ("'.$data["deporte"].'","'.$data["nombre"].'","'.$data["descripcion"].'", "N", 1)');
        }

        $getQuery=$this->db
            ->select('*')
            ->from('liga')
            ->order_by('idliga','DESC')
            ->limit('1')
            ->get();
        $liga = $getQuery->row();

        $this->db->query('INSERT INTO adminby (liga_idliga, usuarios_idusuarios) VALUES ("'.$liga->idliga.'", "'.$this->session->userdata('user')->idusuarios.'")');

    }

    function getLigasAdmin($idDeporte){

        $query=$this->db
            ->select('*')
            ->from('liga')
            ->where('deportes_iddeporte', $idDeporte)
            ->get();
        return $query->result_array();
    }

    /*function getLigasGestor($idDeporte){

        $arr = [];

        $query=$this->db
            ->select('*')
            ->from('adminby')
            ->where('usuarios_idUsuarios', $this->session->userdata('user')->idusuarios)
            ->get();
        $aux = $query->result_array();
        if($aux!=null){
            $getQuery=$this->db
            ->select('*')
            ->from('liga')
            ->where('deportes_iddeporte', $idDeporte)
            ->where('liga_idliga', $aux['idliga'])
            ->get();
        return $getQuery->result_array();
        }
        else{
            return null;
        }
    }*/

    function getLigasFromUserId(){

        $arrEquipos = [];
        $arrEncuentros = [];
        $arrLigas = [];

        $query=$this->db
            ->select('equipos_idequipos')
            ->from('usuario_en_equipo')
            ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
            ->get();
        $aux = $query->result_array();
        if($aux!=null){
            foreach($aux as $equipo){

                $getQueryEq=$this->db
                ->select('*')
                ->from('equipos')
                ->where('idequipos', $equipo['equipos_idequipos'])
                ->get();
                $arrEquipos = $getQueryEq->result_array();
            }

            foreach($arrEquipos as $equipo){
                $getQueryEnc=$this->db
                ->select('*')
                ->from('encuentros')
                ->where('local', $equipo['nombre'])
                ->or_where('visitante', $equipo['nombre'])
                ->get();
                $arrEncuentros = $getQueryEnc->result_array();
            }

            foreach($arrEncuentros as $encuentro){

                $getQueryLig=$this->db
                ->select('*')
                ->from('liga')
                ->where('idliga', $encuentro['liga_idliga'])
                ->get();
                $arrLigas = $getQueryLig->result_array();                
            }
            
        return $arrLigas;
        }
        else{
            return null;
        }
    }

    function getLigasGestor(){

        $arrLigas = [];

        $query=$this->db
            ->select('liga_idliga')
            ->from('adminby')
            ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
            ->get();
        $aux = $query->result_array();
        if($aux!=null){
            foreach($aux as $liga){

                $getQueryLig=$this->db
                ->select('*')
                ->from('liga')
                ->where('idliga', $liga['liga_idliga'])
                ->get();
                $arrLigas = $getQueryLig->result_array();
            }
            
        return $arrLigas;
        }
        else{
            return null;
        }
    }

    function isAdministrable($idliga){

        $query=$this->db
            ->select('*')
            ->from('adminby')
            ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
            ->where('liga_idliga', $idliga)
            ->get();
        $aux = $query->result_array();
        if($aux!=null){
            return true;
        }
        else{
            return false;
        }
    }

    function getLigasPublicas(){

        $query=$this->db
            ->select('*')
            ->from('liga')
            ->where('visible', 1)
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

    function checkIfAnyLeagues(){

        if($this->Usuario->isLogged()){
        $query=$this->db
            ->select('*')
            ->from('adminby')
            ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
            ->get();
        if($query->result_array()==null)
            return false;
        else
            return true;
        }
        else
            return false;
    }

    function isGestorAllowed($idliga){

        if($this->Usuario->isLogged()){
            $query=$this->db
                ->select('*')
                ->from('adminby')
                ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
                ->where('liga_idliga', $idliga)
                ->get();
            if($query->result_array()==null)
                return false;
            else
                return true;
            }
            else
                return false;
    }

    function isUsuarioAllowed($idliga){

        if($this->Usuario->isLogged()){
            $query=$this->db
                ->select('*')
                ->from('adminby')
                ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
                ->where('liga_idliga', $idliga)
                ->get();
            if($query->result_array()==null)
                return false;
            else
                return true;
            }
            else
                return false;
    }

}