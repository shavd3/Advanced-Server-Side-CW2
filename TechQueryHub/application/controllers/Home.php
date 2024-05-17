<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Home extends \Restserver\Libraries\REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('QuestionModel');
    }
    //index method to view home page
    public function index_get()
    {//if user is logged in, load home page and navigation
        if ($this->UserModel->is_logged_in()) {
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('home',array('username' => $this->session->username));
        }
        else {
            $this->load->view('login');
        }
    }
    //api to get all questions
    public function userQuestions_get(){
        if ($this->UserModel->is_logged_in()) {
            $username = $this->get('username');
            $result=$this->QuestionModel->getQuestions($username);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //api to get answers for questions
    public function answers_get(){
        if ($this->UserModel->is_logged_in()) {
            $questionid = $this->get('questionid');
            $result=$this->QuestionModel->getAnswers($questionid);
            $this->response($result);
        }
        else {
            $this->load->view('login');
        }
    }
    //post request to add answers
    public function answers_post(){
        if ($this->UserModel->is_logged_in()) {
            $username = $this->session->username;
            $questionid = $this->post('questionid');
            $answer = $this->post('answer');
            $result=$this->QuestionModel->addAnswers($questionid, $answer, $username);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //get request to check votes
    public function checkVotes_get(){
        if ($this->UserModel->is_logged_in()) {
            $username = $this->session->username;
            $questionid = $this->get('questionid');
            $result=$this->QuestionModel->checkVotes($username, $questionid);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //post request to vote
    public function vote_post(){
        if ($this->UserModel->is_logged_in()) {
            $username = $this->post('username');
            $questionid = $this->post('questionid');
            $result=$this->QuestionModel->voteQuestion($username, $questionid);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    
}