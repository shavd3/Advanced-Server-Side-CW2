<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Questions extends \Restserver\Libraries\REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('QuestionModel');
    }

    // Index route to create post view
    public function index_get(){
        if ($this->UserModel->is_logged_in()) {
            $this->load->view('navigation', array('username' => $this->session->username));
            $this->load->view('addQuestion');
        }
        else {
            $this->load->view('login');
        }
    }

    // Function to save the profile picture image in folder
    public function profpic_post() {
        if ($this->UserModel->is_logged_in()) {
            $config['upload_path'] = "./images/profilepics/";
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('result' => 'failed', 'error' => $this->upload->display_errors());
                $this->response($error);
            } else {
                $data = array('result' => 'done', 'image_metadata' => $this->upload->data());
                $this->response($data);
            }
        }
        else {
            $this->load->view('login');
        }
    }

    // Post request to add a question
    public function addQuestion_post() {
        if ($this->UserModel->is_logged_in()) {
            $username = $this->session->username;
            $tagId = $this->post('tagid');
            $title = $this->post('title');
            $description = $this->post('description');
            $result = $this->QuestionModel->addQuestion($username, $tagId, $title, $description);

            if ($result) {
                $this->response(array('result' => 'done'));
            } else {
                $this->response(array('result' => 'failed'));
            }
        }
        else {
            $this->load->view('login');
        }
    }

    // API to get all questions from a user
    public function userQuestions_get(){
        $username = $this->get('username');
        $result = $this->QuestionModel->getQuestionsfromUsername($username);
        $this->response($result);
    }

    // Get the tag view
    public function tagView_get() {
        if ($this->UserModel->is_logged_in()) {
            $tagid = $this->get('tagid');
            $this->load->view('navigation', array('username' => $this->session->username));
            $this->load->view('categories', array('tagid' => $tagid));
        }
        else {
            $this->load->view('login');
        }
    }

    // API to get tags
    public function tags_get() {
        // Action all gets all tags
        if($this->get('action') == 'all') {
            $tags = $this->QuestionModel->getTags();
            if ($tags) {
                $this->response($tags);
            } else {
                $this->response(NULL);
            }
        }
        // Action id get the questions by its id
        if($this->get('action') == 'id') {
            $tagid = $this->get('tagid');
            $tags = $this->QuestionModel->getTagbyId($tagid);
            $this->response($tags);
        }
    }

    // API to get questions from given tags
    public function tagQuestions_get(){
        if ($this->UserModel->is_logged_in()) {
            $tagid = $this->get('tagid');
            $result = $this->QuestionModel->questionsFromTags($tagid);
            $this->response($result);
        }
        else {
            $this->load->view('login');
        }
    }

    // API to get the vote count
    public function voteCount_get(){
        if ($this->UserModel->is_logged_in()) {
            $voteCount = $this->get('voteCount');
            $result = $this->QuestionModel->voteCount($voteCount);
            $this->response($result);
        }
        else {
            $this->load->view('login');
        }
    }

    // API to get questions details or load the questions view
    public function question_get() {
        if ($this->UserModel->is_logged_in()) {
            $questionid = $this->get('questionid');
            // If action is view, get questions details from id
            if($this->get('action') == 'view') {
                $result = $this->QuestionModel->getQuestionFromId($questionid);
                $this->response($result);
            }
            // Else load the questions view
            else{
                $this->load->view('navigation', array('username' => $this->session->username));
                $this->load->view('question', array('questionid' => $questionid,'username' => $this->session->username));
            }
        }
        else {
            $this->load->view('login');
        }
    }
}
