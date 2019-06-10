<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ligas extends CI_Controller {


    function index(){

        if(! $this->Leagues->checkIfAnyLeagues() && ($this->Usuario->isGestor() || $this->Usuario->isAdmin())){

            $this->load->view('template', 
                ['body'=>$this->load->view('addLeague',[], true)]);
        }
        else if($this->Usuario->isLogged()){
            $this->load->view('template', 
                ['body'=>$this->load->view('isLogged',[], true)]);
        }
        else{
            $this->load->view('template', 
                ['body'=>$this->load->view('notLogged',[], true)]);
        }
    }

    function addLiga(){

        $deportes = $this->Deportes->getDeportes();

        $this->load->view('template',
                ['body'=>$this->load->view('liga',['deportes'=>$deportes],true)]);
        
    }

    function gestionLigasAdmin(){

        $deportes = $this->Deportes->getDeportes();
        $encuentros = [];

        if($this->input->post('selectDeporte')!=null){
            $ligas = $this->Leagues->getLigasAdmin($this->input->post('selectDeporte'));

            if($this->input->post('selectLiga')!=null){
                $encuentros = $this->Deportes->getEncuentrosByLigaId($this->input->post('selectLiga'));
            }
        }
        else{
            $ligas = $this->Leagues->getAllLigas();
        }

        $this->load->view('template', 
                ['body'=>$this->load->view('ligasAdmin',[
                    'deportes' => $deportes,'ligas' => $ligas, 'encuentros' => $encuentros], true)]);

    }
    
    function setLiga(){

        $deportes = $this->Deportes->getDeportes();

        $this->form_validation->set_rules('deporte', 'Deporte', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');

        $this->form_validation->set_rules('deporte', 'Deporte', 'required',
                array('required' => 'Campo requerido'));
        $this->form_validation->set_rules('nombre', 'Nombre', 'required',
                array('required' => 'Campo requerido'));

        if ($this->form_validation->run() == FALSE){
            $this->load->view('template', 
                ['body'=>$this->load->view('liga',['deportes' => $deportes], true)]);
        }
        else{
            $this->Leagues->setLiga($this->input->post());
            
            $this->load->view('template',
                    ['body'=>$this->load->view('completed',[],true)]);
        }
    }

    function getLigas(){
        
        $ligas = [];

        if($this->Usuario->isAdmin()){

            $ligas = $this->Leagues->getAllLigas();

            $this->load->view('template', 
                    ['body'=>$this->load->view('ligasByLogged',['ligas' => $ligas], true)]);
        }

        else if($this->Usuario->isGestor() || $this->Usuario->isLogged()){
            
            $arrLigas = [];
            if($this->Usuario->isGestor()){
                $ligas = $this->Leagues->getLigasGestor();
                foreach($ligas as $liga){
                    foreach($liga as $lig){
                        $arrLigas[] = $lig;
                    }
                }
                if($ligas != null){
                $this->load->view('template', 
                    ['body'=>$this->load->view('ligasByLogged',['ligas' => $arrLigas], true)]);
                }
            }
            else{
                $ligas = $this->Leagues->getLigasFromUserId();
                if($ligas != null){
                    $this->load->view('template', 
                        ['body'=>$this->load->view('ligasByLogged',['ligas' => $ligas], true)]);
                }
                else{
                    redirect('Ligas/getLigasPublicas');
                }
            }
        }
        else{
            redirect('Ligas/getLigasPublicas');
        }
    }

    function getLigasPublicas(){

        $ligas = $this->Leagues->getLigasPublicas();

            $this->load->view('template', 
                ['body'=>$this->load->view('ligaspublicas',['ligas' => $ligas], true)]);
    }

    function modifyLiga($id){

        $liga= $this->Leagues->getLigaFromId($id);
        $equipos = $this->Deportes->getEquiposByDeporteId($liga->deportes_iddeporte);
        $gestores = $this->Usuario->getGestores($id);

        if($this->input->post()){

            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required',
                    array('required' => 'Campo requerido'));
            
            if ($this->form_validation->run() == FALSE){

                $this->load->view('template', 
                    ['body'=>$this->load->view('modifyLeague',['liga' => $liga, 'equipos' => $equipos, 'gestores' => $gestores], true)]);
            }
            else{

                if($this->input->post('gestores[]') != null){
                    foreach($this->input->post('gestores[]') as $gestor){
                        $this->Leagues->setGestor($gestor, $id);
                    }
                }
                if($this->input->post('equipos[]') != null){
                    foreach($this->input->post('equipos[]') as $equipo){
                        $this->Leagues->setEquipo($equipo, $id);
                    }
                }
                $this->Leagues->modifyLeague($id, $this->input->post());
                
                $this->load->view('template',
                        ['body'=>$this->load->view('completed',[],true)]);
            }

        }
        else{

            $this->load->view('template', 
                ['body'=>$this->load->view('modifyLeague',['liga' => $liga, 'equipos' => $equipos, 'gestores' => $gestores], true)]);
        }  
    }

    public function setEncuentros($id){

        $equipos = $this->Deportes->getEquiposByLigaId($id);
        $liga = $this->Leagues->getLigaFromId($id);
        $mensaje = '';

        if($this->input->post()){
            
            $this->form_validation->set_rules('fecha', 'Fecha', 'required|callback_validafecha_check');
            $this->form_validation->set_rules('lugar', 'Lugar', 'required');
            
            $this->form_validation->set_rules('fecha', 'Fecha', 'required|callback_validafecha_check',
                    array('required' => 'Campo requerido'));
            $this->form_validation->set_rules('lugar', 'Lugar', 'required',
                    array('required' => 'Campo requerido'));

            if($this->input->post('local') == $this->input->post('visitante')){
                $mensaje = "No pueden ser iguales los equipos.";
            }
            
            if ($this->form_validation->run() == FALSE || $mensaje != ''){
                
                $this->load->view('template', 
                    ['body'=>$this->load->view('setEncuentro',['equipos' => $equipos, 'liga' => $liga, 'mensaje' =>$mensaje], true)]);
            }
            else{

                $this->Deportes->setEncuentro($this->input->post(), $id, $liga->deportes_iddeporte);
                
                $this->load->view('template', 
                    ['body'=>$this->load->view('completed',[], true)]);
            }
        }

        else{
            $this->load->view('template', 
                ['body'=>$this->load->view('setEncuentro',['equipos' => $equipos, 'liga' => $liga, 'mensaje' =>$mensaje], true)]);
        }
    }

    function validafecha_check($fecha){

        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fecha)) {
            return true;
        } else {
            $this->form_validation->set_message('validafecha_check', 'Formato incorrecto');
            return false;
        }
    }

    function deleteLiga($id){

        $this->Leagues->deleteLiga($id);

        $this->load->view('template',
                ['body'=>$this->load->view('completed',[],true)]);
    }


}
