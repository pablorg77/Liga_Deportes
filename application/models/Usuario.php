<?php

class Usuario extends CI_Model{

    function setRegistro($data){

        $newPass=password_hash($data['pass'], PASSWORD_DEFAULT);
        
        $this->db->query('INSERT INTO usuarios (usuario, pass, nombre, apellidos, tipo, correo) 
        VALUES ("'.$data["user"].'","'.$newPass.'","'.$data["nombre"].'","'.$data["apellidos"].'", 3,"'.$data["email"].'")');
    }

    function changeTypeToAdmin($id){

        $this->db
        ->set('tipo', 1)
        ->where('idusuarios', $id)
        ->update('usuarios');
    }

    function changeTypeToGestor($id){

        $this->db
        ->set('tipo', 2)
        ->where('idusuarios', $id)
        ->update('usuarios');
    }

    function changeTypeToUser($id){

        $this->db
        ->set('tipo', 3)
        ->where('idusuarios', $id)
        ->update('usuarios');
    }

    function login($user, $pass){

        $query=$this->db
            ->select('*')
            ->from('usuarios')
            ->where('usuario', $user)
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

    function isAdmin(){
        if($this->session->has_userdata('user')){
            if($this->session->userdata('user')->tipo == 1){
                return true;
            }
        }
        else 
            return false;
    }

    function isGestor(){
        if($this->session->has_userdata('user')){
            if($this->session->userdata('user')->tipo == 2){
                return true;
            }
        }
        else 
            return false;
    }

    function logOut(){

        $this->session->set_userdata('isIn',false);
        $this->session->unset_userdata('user');

    }


}
