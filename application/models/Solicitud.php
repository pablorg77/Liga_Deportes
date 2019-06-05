<?php

class Solicitud extends CI_Model{
	
	function getSolicitudes(){
		 $query=$this->db
            ->select('*')
			->from('solicitudes')
			->where('borrado', 'N')
            ->get();
        return $query->result_array();
	}

	function getSolicitudById($idSol){
		$query=$this->db
            ->select('*')
			->from('solicitudes')
			->where('borrado', 'N')
			->where('idsolicitudes', $idSol)
            ->get();
        return $query->row();
	}
	
	function setSolicitud($data){

		$query=$this->db
            ->select('*')
			->from('solicitudes')
			->where('borrado', 'S')
			->where('usuarios_idusuarios', $this->session->userdata('user')->idusuarios)
            ->get();
		$aux = $query->row();
		if($aux!=null){
			return false;
		}
		else{
			$this->db->query('INSERT INTO solicitudes (usuarios_idusuarios, nombre, telefono, residencia, dni, aceptada, borrado) 
        	VALUES ("'.$this->session->userdata('user')->idusuarios.'","'.$this->session->userdata('user')->usuario.
			'","'.$data["telefono"].'","'.$data["residencia"].'","'.$data["dni"].'", 0, "N")');

			return true;
		}
		
	}
	
	function setBorradoSolicitud($idSol){
		$this->db
        ->set('borrado', 'S')
        ->where('idsolicitudes', $idSol)
        ->update('solicitudes');
	}

	function aceptar($idSol){
		$this->db
        ->set('aceptada', 'S')
        ->where('idsolicitudes', $idSol)
        ->update('solicitudes');
	}

	function denegar($idSol){
		$this->db
        ->set('aceptada', 'N')
        ->where('idsolicitudes', $idSol)
        ->update('solicitudes');
	}

	function getSolicitudesGestionadas(){
		$query=$this->db
            ->select('*')
			->from('solicitudes')
			->where('borrado', 'S')
            ->get();
        return $query->result_array();
	}


}