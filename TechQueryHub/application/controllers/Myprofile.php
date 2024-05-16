<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Myprofile extends \Restserver\Libraries\REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('QuestionModel');

        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *');
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); 
    }
    //index method to view myProfile page
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
    //api to get users question details
    public function myQuestions_get(){
        $username = $this->session->username;
        $result = $this->QuestionModel->getQuestionsfromUsername($username);
        $this->response($result);
    }
}