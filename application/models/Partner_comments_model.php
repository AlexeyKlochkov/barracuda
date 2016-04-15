<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_comments_model extends CI_Model {

    public $partner_id;
    public $program_id;
    public $partner_comments;


    public function __construct()
    {
        parent::__construct();
    }

    public function insertComments($partner_id, $program_id, $comments)
    {
        
        $this->partner_id       = $partner_id;
        $this->program_id       = $program_id;
        $this->partner_comments = $comments;

        $this->db->insert('partner_comments', $this);
        return $this->db->insert_id();
    }

    public function getComments($partner_id, $program_id)
    {


    }


}