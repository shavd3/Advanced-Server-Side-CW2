<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->load->view('login');
    }

    public function login_user() {
        // Add your login logic here
    }
}
