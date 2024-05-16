<?php
defined('BASEPATH') or exit('No direct script access allowed');

//model for question related database tasks
class QuestionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //insert rows to questions table
    function addQuestion($username, $tagid, $title, $Description)
    {
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $data = array('UserId' => $userId, 'TagId' => $tagid, 'Title' => $title, 'Description' => $Description);
        if ($this->db->insert('questions', $data)) {
            return True;
        } else {
            return False;
        }
    }
    //query post table to get questions from a user
    function getQuestionsfromUsername($username)
    {
        //"SELECT posts.*, users.Username, location.LocationName FROM posts JOIN users ON users.UserId=posts.UserId JOIN location ON location.LocationId=posts.LocationId ORDER BY Timestamp DESC");

        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
//        $query=$this->db->query( "SELECT * FROM posts WHERE UserId=".$userId." ORDER BY Timestamp DESC");
        $query=$this->db->query("SELECT questions.*, tags.TagName FROM questions JOIN tags ON 
                                    tags.TagId = questions.TagId WHERE UserId=".$userId." ORDER BY questions.Timestamp DESC");
        return $query->result();
    }
    //get all tags from db
    function getTags(){
        $query = $this->db->get('tags');
        if ($query) {
            return $query->result();
        }
        return NULL;
    }
    //query database to get questions, users and tags
    function getQuestions($username){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $query=$this->db->query("SELECT questions.*, users.Username, tags.TagName FROM questions 
                                JOIN users ON users.UserId=questions.UserId 
                                JOIN tags ON tags.TagId=questions.TagId 
                                ORDER BY Timestamp DESC");
        return $query->result();
    }
    //query table to get the answers per post
    function getAnswers($questionid){
        $answers = $this->db->query( "SELECT answers.*,users.Username FROM answers 
                                        JOIN users ON users.UserId=answers.UserId WHERE QuestionId=".$questionid." 
                                        ORDER BY Timestamp DESC");
        return $answers->result();
    }
    //insert rows to answers table
    function addAnswers($questionid, $answer, $username){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $posts = $this->db->get_where('questions', array('QuestionId' => $questionid));
        $postuser= $posts->row()->UserId;
        $query=$this->db->insert('answers', array('UserId' => $userId,'QuestionId' => $questionid,'AnswerBody' => $answer));
        return $query;
    }
    //query like table to check if a user has voted a question
    public function checkVotes($username, $questionid){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $res = $this->db->get_where('votes', array('UserId' => $userId,'QuestionId' => $questionid));
        if ($res->num_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }
    //insert or delete row in votes table
    public function voteQuestion($username, $questionid){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $res = $this->db->get_where('votes', array('UserId' => $userId,'QuestionId' => $questionid));
        if ($res->num_rows() == 1){
            $query=$this->db->delete('votes', array('UserId' => $userId,'QuestionId' => $questionid));
            return $query;
        }
        else{
            $query=$this->db->insert('votes', array('UserId' => $userId,'QuestionId' => $questionid));
            return $query;
        }
    }
    //query questions table to get questions from tag
    public function questionsFromTags($tagId){
        $res = $this->db->get_where('questions', array('TagId' => $tagId));
        return $res->result();
    }
    //query tags by tag Id
    public function getTagbyId($tagId){
        $res = $this->db->get_where('tags', array('TagId' => $tagId));
        return $res->row();
    }
    //query questions by question id
    public function getQuestionFromId($questionid){
        $res = $this->db->query( "SELECT questions.*, users.Username, users.UserImage, tags.TagName 
                                    FROM questions JOIN users ON users.UserId=questions.UserId 
                                    JOIN tags ON tags.TagId=questions.TagId 
                                    WHERE questions.QuestionId =".$questionid);
        return $res->row();
    }
    //get number of rows from votes table according to question id
    public function voteCount($questionid){
        $res2 = $this->db->get_where('votes', array('QuestionId' => $questionid));
        $votes=$res2->num_rows();
        return $votes;
    }
} 