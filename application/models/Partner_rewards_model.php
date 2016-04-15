<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_rewards_model extends CI_Model {

    public $partner_id;
    public $program_id;
    public $course_id;
    public $product_id;
    public $comment_id;
    public $reward;
    public $date_completed;
    public $status;
    public $timestamp;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_training_courses($partner_id, $program_id, $course_id, $comment_id, $reward, $date_completed )
    {
        $this->partner_id      = $partner_id;
        $this->program_id      = $program_id;
        $this->course_id       = $course_id;
        $this->comment_id      = $comment_id;
        $this->reward          = $reward;
        $this->date_completed  = $date_completed;
        $this->timestamp       = "2016-04-12";
        $this->status          ="pending";
        $this->timestamp       = "2016-04-12";

        $this->db->insert('partner_rewards', $this);
    }

    public function insert_product_rewards($partner_id, $program_id, $product_id, $comment_id, $reward, $date_completed )
    {
        $this->partner_id      = $partner_id;
        $this->program_id      = $program_id;
        $this->product_id      = $product_id;
        $this->comment_id      = $comment_id;
        $this->reward          = $reward;
        $this->date_completed  = $date_completed;
        $this->timestamp       = "2016-04-12";
        $this->status          ="pending";


        $this->db->insert('partner_rewards', $this);
    }
    
    
    public function getPartnerRewards($partner_id){

        $query = "select `partner_rewards`.`timestamp`, `partner_rewards`.`reward`,`partner_rewards`.`status`,
                  `programs`.`program_title`, `programs`.`program_type` from `partner_rewards` Left JOIN 
                  `programs` ON `partner_rewards`.`program_id`= `programs`.`program_id` 
                  where `partner_rewards`.`partner_id`='" . $partner_id ."'" ;

            $query = $this->db->query($query);

            if($query->num_rows() > 0){

            return $query->result();
            }

            return false;
    }
    public function getPartnerRewardsBySum($partner_id){


        $query = "select `partner_rewards`.`timestamp`, sum(`partner_rewards`.`reward`) as rewards,
                `partner_rewards`.`status`,`programs`.`program_title`, `programs`.`program_type` from 
                `partner_rewards` JOIN `programs` ON `partner_rewards`.`program_id`= `programs`.`program_id`
                 where `partner_rewards`.`partner_id`='" . $partner_id ."'GROUP BY  `programs`.`program_title`";

        $query = $this->db->query($query);

        if($query->num_rows() > 0){

            return $query->result();
        }

        return false;

    }
    public function getPartnerRequest()
    {
        $query = "select `partner_rewards`.`timestamp`, `partner_rewards`.`reward`,`partners`.`company`,
                `partner_rewards`.`status`,`programs`.`program_title`, `programs`.`program_type` from
                 `partner_rewards` JOIN `programs` ON `partner_rewards`.`program_id`= `programs`.`program_id`
                  JOIN `partners` ON `partner_rewards`.`partner_id` = `partners`.`partner_id`";

        $query = $this->db->query($query);

        if($query->num_rows() > 0){

            return $query->result();
        }

        return false;
    }

}