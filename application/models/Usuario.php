<?php

class Usuario extends CI_Model{

    function setRegistro($data){

        $newPass=password_hash($data['pass'], PASSWORD_DEFAULT);
        
        $this->db->query('INSERT INTO usuarios (usuario,pass,nombre,apellidos) 
        VALUES ("'.$data["user"].'","'.$newPass.'","'.$data["nombre"].'","'.$data["apellidos"].'")');
    }

    function changeTypeToManager($id){

        $this->db
        ->set('tipo', 2)
        ->where('idusuarios',$id)
        ->update('usuarios');
    }

    function changeTypeToUser($id){

        $this->db
        ->set('tipo', 3)
        ->where('idusuarios',$id)
        ->update('usuarios');
    }

    function login($user, $pass){

        $query=$this->db
            ->select('*')
            ->from('usuarios')
            ->where('usuario',$user)
            ->get();
        $user_data=$query->row();
        if (!$user_data){
            return false;
        }

        if(! password_verify($pass,$user_data->pass)) {
            return false;
        }
            
            $this->session->set_userdata('isIn',true);
            $this->session->set_userdata('user',$user_data);
        return true;
    }

    function isLogged(){

        if($this->session->userdata('isIn')==true)
            return true;
        else return false;

    }

    function getDataFromLoggedUser(){

        if($this->isLogged())
            $id=$this->session->userdata('user')->idusuario;
        else
            $id='';

        $query=$this->db
        ->select('*')
        ->from('usuarios')
        ->where('idusuarios',$id)
        ->get();
            return $query->row();
    }

    function getUsername(){

        echo "<div style='float:right;color:white'>Bienvenido: ". $this->session->userdata('user')->nombre ." ".
            $this->session->userdata('user')->apellidos."</div>";
        
    }

    function changePassFromId($id, $newPass){

        $newPass=password_hash($newPass, PASSWORD_DEFAULT);

        $this->db
        ->set('pass', $newPass)
        ->where('idusuarios',$id)
        ->update('usuarios');

    }

    function logOut(){

        $this->session->set_userdata('isIn',false);
        $this->session->unset_userdata('usuario');

    }


}
