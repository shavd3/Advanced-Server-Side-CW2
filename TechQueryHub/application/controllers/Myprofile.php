<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Myprofile extends \Restserver\Libraries\REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('QuestionModel');
    }
    //index method to view myprofile page
    public function index_get(){
        if ($this->UserModel->is_logged_in()) {
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('myProfile',array('username' => $this->session->username));
        }
        else {
            $this->load->view('login');
        }
    }
    //edit profile view
    public function editprofile_get(){
        if ($this->UserModel->is_logged_in()) {
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('editProfile',array('username' => $this->session->username));
        }
        else {
            $this->load->view('login');
        }
    }
    //get questions the user added
    public function myQuestions_get(){
        $username = $this->session->username;
        $result = $this->QuestionModel->getQuestionsfromUsername($username);
        $this->response($result);
    }
}