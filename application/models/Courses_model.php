<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Courses_model extends CI_Model {

    public $course_title;
    public $course_status;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_course()
    {
        $this->course_title    = $this->input->post('course_title',true);
        $this->course_status   = $this->input->post('course_status', true);

        $this->db->insert('courses', $this);
    }

    public function findCourse($course_title)
    {
        $course = $this->db
            ->get_where('courses', array( 'course_title'=> $course_title))
            ->row();

        return $course;

    }

    public function getCourses()
    {
        $query = $this->db->get_where('courses', array('course_status' => 'active'));

        if ($query->num_rows() > 0) {
           return  $query->result();

        }
    }

    public function getCoursesByRewardName($reward_name)
    {
        $query ="Select `courses`.`course_id`,`courses`.`course_title`,`courses`.`reward_amount` from `courses` JOIN 
                `program_rewards_courses` ON `program_rewards_courses`.`course_id` = `courses`.`course_id`
                  JOIN  `programs` ON `program_rewards_courses`.`program_id` = `programs`.`program_id` 
                  where `programs`.`program_title` ='" . $reward_name ."'" ;

        $query = $this->db->query($query);

        if($query->num_rows() > 0){

            return $query->result();
        }

        return false;
    }
    public function getCoursesRewardsPlans()
    {
        $query = "SELECT `courses`.`course_id`,`courses`.`course_title`,`programs`.`program_id`,
                  `programs`.`program_title`,`programs`.`program_type` from `courses` JOIN `program_rewards_courses`on
                   `courses`.`course_id`= `program_rewards_courses`.`course_id` JOIN `programs` on 
                   `program_rewards_courses`.`program_id` = `programs`.`program_id` GROUP BY 
                   `courses`.`course_title`";
    }
}