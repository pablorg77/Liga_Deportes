<?php

class Leagues extends CI_Model{

    function getAllLigas(){
        $query=$this->db
            ->select('*')
            ->from('liga')
            ->where('borrado', 'N')
            ->order_by('deportes_iddeporte')
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

    function modifyLeague($id, $data){
        if(! isset($data['visible'])){
            $this->db
                ->set('nombre', $data['nombre'])
                ->set('descripcion', $data['descripcion'])
                ->where('idliga', $id)
                ->update('liga');
        }
        else{
            $this->db
                ->set('nombre', $data['nombre'])
                ->set('descripcion', $data['descripcion'])
                ->set('visible', $data['visible'])
                ->where('idliga', $id)
                ->update('liga');
        }
        
    }

    function getLigasAdmin($idDeporte){

        $query=$this->db
            ->select('*')
            ->from('liga')
            ->where('deportes_iddeporte', $idDeporte)
            ->where('borrado', 'N')
            ->order_by('deportes_iddeporte')
            ->get();
        return $query->result_array();
    }

    function getLigasFromUserId(){

        $arrEquipos = [];
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
                ->select('liga_idliga')
                ->from('equipo_en_liga')
                ->where('equipos_idequipos', $equipo['equipos_idequipos'])
                ->get();
                $arrEquipos[] = $getQueryEq->result_array();
            }
            foreach($arrEquipos as $equip){
                foreach($equip as $e){
                    $arrEquipos = $e;
                }
            }
            foreach($arrEquipos as $idLiga){
                $getQueryLig=$this->db
                ->select('*')
                ->from('liga')
                ->where('idliga', $idLiga)
                ->where('borrado', 'N')
                ->order_by('deportes_iddeporte')
                ->get();
                $arrLigas[] = $getQueryLig->result_array();                
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
                ->where('borrado', 'N')
                ->order_by('deportes_iddeporte')
                ->get();
                $arrLigas[] = $getQueryLig->result_array();
            }
            
        return $arrLigas;
        }
        else{
            return null;
        }
    }

    function getLigasPublicas(){

        $query=$this->db
            ->select('*')
            ->from('liga')
            ->where('visible', 1)
            ->where('borrado', 'N')
            ->order_by('deportes_iddeporte')
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
                ->where('borrado', 'N')
                ->get();
                $arrLigas = $getQueryLig->result_array();                
            }
            
            if($arrLigas != null){
                return true;
            }
        }
        else{
            return false;
        }
    }

    function modifyLiga($data, $id){
  
        $this->db->query('UPDATE liga SET nombre = "'.$data["nombre"].'", descripcion = "'.$data["descripcion"].'",
        visible = '.$data['visible'].' WHERE idliga = "'.$id.'"');
    }

    function setGestor($idGestor, $idliga){

        $query=$this->db
            ->select('*')
            ->from('adminby')
            ->where('liga_idliga', $idliga)
            ->where('usuarios_idusuarios', $idGestor)
            ->get();
        $aux = $query->result_array();
        if($aux == null){
        $this->db->query('INSERT INTO adminby (liga_idliga, usuarios_idusuarios) VALUES('.$idliga.', '.$idGestor.')');
        }
        else{
            return false;
        }
    }

    function setEquipo($equipoId, $idliga){
        $query=$this->db
            ->select('*')
            ->from('equipo_en_liga')
            ->where('liga_idliga', $idliga)
            ->where('equipos_idequipos', $equipoId)
            ->get();
        $aux = $query->result_array();
        if($aux == null){
            $this->db->query('INSERT INTO equipo_en_liga (liga_idliga, equipos_idequipos) VALUES('.$idliga.', '.$equipoId.')');
        }
        else{
            return false;
        }
        
    }

    function deleteLiga($id){

        $this->db
        ->set('borrado', 'S')
        ->where('idliga', $id)
        ->update('liga');
    }

}