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

    function getEncuentroById($id){
        $query=$this->db
            ->select('*')
            ->from('encuentros')
            ->where('idencuentros', $id)
            ->get();
        return $query->row();
    }

    function getEquipos(){
        $query=$this->db
        ->select('*')
        ->from('equipos')
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

    function getEquiposByLigaId($idliga){

        $arrEquipos = [];

        $query=$this->db
            ->select('equipos_idequipos')
            ->from('equipo_en_liga')
            ->where('liga_idliga', $idliga)
            ->get();
        $equiposId = $query->result_array();
        if($equiposId!=null){
            foreach($equiposId as $id){
                $queryEq=$this->db
                ->select('*')
                ->from('equipos')
                ->where('idequipos', $id['equipos_idequipos'])
                ->get();
                $arrEquipos[] = $queryEq->result_array();
            }
            return $arrEquipos;
        }
        else{
            return null;
        }
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

    function modifyEncuentro($id, $data){
        $this->db
            ->set('resultado', $data['resultado'])
            ->set('resultadoLocal', $data['resultadoLocal'])
            ->set('resultadoVisitante', $data['resultadoVisitante'])
            ->where('idencuentros', $id)
            ->update('encuentros');
    }

    function setNotify($equipoId){
        $this->db
        ->set('notificacion', 1)
        ->where('equipos_idequipos', $equipoId)
        ->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
        ->update('usuario_en_equipo');
    }

    function setEncuentro($data, $idliga, $iddeporte){

        $this->db->query('INSERT INTO encuentros (fecha, local, visitante, deportes_iddeporte, liga_idliga, lugar) 
        	VALUES ("'.$data['fecha'].'","'.$data['local'].'","'.$data["visitante"].'","'.$iddeporte.'","'.$idliga.'", "'.$data["lugar"].'")');
        
    }

    function setEquipo($data){
        $this->db->query('INSERT INTO equipos (nombre, descripcion, capitan, deportes_iddeporte, borrado, origen) 
        VALUES ("'.$data['nombre'].'","'.$data['descripcion'].'","'.$data['capitan'].'","'.$data['deportes_iddeporte'].
        '","N", "'.$data['origen'].'")');

    }

    function setUsuarioEnEquipo($usuario){

            $getQuery=$this->db
            ->select('*')
            ->from('equipos')
            ->order_by('idequipos','DESC')
            ->limit('1')
            ->get();
        $equipo = $getQuery->row();
        
        $this->db->query('INSERT INTO usuario_en_equipo (usuarios_idusuarios, equipos_idequipos) VALUES
        ('.$usuario.', '.$equipo->idequipos.')');

    }
    

}
