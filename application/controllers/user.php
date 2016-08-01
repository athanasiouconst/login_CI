<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        if ($this->session->userdata('userIsLoggedIn')) {
            //authentication of user
            $data['is_authenticated'] = $this->session->userdata('userIsLoggedIn');

            //user information
            $data['uid'] = $this->session->userdata('uid');
            //pass username to home page
            $data['username'] = $this->session->userdata('username');
            //view the home page
            $this->load->view('user/home', $data);
        } else {
            //if not authentication the go to Login Page
            $data['is_authenticated'] = FALSE;
            $this->load->view('user/login', $data);
        }
    }

    public function Verify() {
        //call model
        $this->load->model('usermodel');
        //call library valdiation 
        $this->load->library('form_validation');

        $error = '';
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //form validation to login page
        //$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean', array('xss_clean' => 'Error Message: Username is required'));
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean', array('xss_clean' => 'Error Message: Password is required'));

        if ($this->form_validation->run() == FALSE) {
            $data['is_authenticated'] = FALSE;
            //pass the error to the page
            $data['error'] = '<h2>Wrong Password! <br>Try again! </h2>';
            $this->load->view('user/login', $data);
        } else {

            if ($this->usermodel->Login($this->input->post('username'), $this->input->post('password'))) {
                //set session data
                $this->session->set_userdata('userIsLoggedIn', 'true');
                $this->session->set_userdata('username', $this->input->post('username'));
                
                //$uid = $this->usermodel->GetId($this->input->post('username'));
                //$this->session->set_userdata('uid', $uid);
                //redirect to user home page
                $this->session->set_flashdata('success_msg', ''
                            . 'Succesfull Login!'
                            . '');
                redirect('user/home', 'refresh');
            } else {
                $data['error'] = '<h2>Wrong Password! <br>Try again! </h2>';
                $data['is_authenticated'] = FALSE;
                $this->load->view('user/login', $data);
            }
        }
    }

    public function Home() {
        if ($this->session->userdata('userIsLoggedIn')) {

            $data['username'] = $this->session->userdata('username');
            $data['is_authenticated'] = $this->session->userdata('userIsLoggedIn');
            $data['uid'] = $this->session->userdata('uid');

            //user information
            $data['username'] = $this->session->userdata('username');
            $data['uid'] = $this->session->userdata('uid');

            
            //load User home page
            $this->load->view('user/home', $data);
        } else {
            $data['is_authenticated'] = FALSE;
            $this->load->view('User/Login', $data);
        }
    }

    public function Logout() {

        if ($this->session->userdata('userIsLoggedIn')) {
            $this->session->unset_userdata('userIsLoggedIn');
            $this->session->unset_userdata('username');
            
            $this->session->set_flashdata('success_msg', ''
                            . 'Succesfull Logout!'
                            . '');
            
            redirect('user', 'refresh');
        }
    }

}
