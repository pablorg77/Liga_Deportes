<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Usuario');
        //$this->load->model('Emailme');
    }

    public function login(){

        if($this->input->post()){

            if($this->Usuario->login($this->input->post('usuario'),$this->input->post('pass'))){
                
                redirect('Principal');
            }
            else{
                
                $this->load->view('template',[
                    'body'=>$this->load->view('index', [], true)]);
            }
        }
        

        else{
            $this->load->view('template',[
                'body'=>$this->load->view('index', [], true)]);
        }
        
    }

    public function register(){

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user', 'user', 'required');
        $this->form_validation->set_rules('pass', 'pass', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',
                array('required' => 'Campo requerido', 
                'valid_email' => 'Formato incorrecto'));
        $this->form_validation->set_rules('user', 'user', 'required',
                array('required' => 'Campo requerido'));
        $this->form_validation->set_rules('pass', 'pass', 'trim|required|min_length[6]',
                array('required' => 'Campo requerido', 
                'min_length[6]' => 'Longitud mínima de 6 caracteres'));
        $this->form_validation->set_rules('nombre', 'Nombre', 'required',
                array('required' => 'Campo requerido'));
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required',
                array('required' => 'Campo requerido'));     

        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('template',
                ['body'=>$this->load->view('register',[],true)]);
            }
            else
            {
                $this->load->view('template',
                ['body'=>$this->load->view('index',[],true)]);

                $this->Usuario->setRegistro($this->input->post());
            }
    }

    public function accOptions(){
        
        $this->load->view('template',[
            'body'=>$this->load->view('options', [], true)]);

    }

    public function logOut(){

        $this->Usuario->logOut();
        redirect('Principal');
    }
      
}