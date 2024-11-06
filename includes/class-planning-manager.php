<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Planning_Manager
 * Handles all functionalities related to course planning
 */
class Planning_Manager {

    // Table name
    private $table_name;

    /**
     * Constructor to initialize the class
     */
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'teacher_courses';
    }

    /**
     * Add a new course
     * 
     * @param string $course_title
     * @param string $class_name
     * @param int $teacher_id
     * @param string $start_datetime
     * @param string $end_datetime
     * @param string $room_number
     * @param string $description
     * @return bool|int
     */
    public function add_course($course_title, $class_name, $teacher_id, $start_datetime, $end_datetime, $room_number, $description) {
        global $wpdb;

        $data = array(
            'course_title' => $course_title,
            'class_name' => $class_name,
            'teacher_id' => $teacher_id,
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
            'room_number' => $room_number,
            'description' => $description,
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql')
        );

        $format = array('%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s');

        return $wpdb->insert($this->table_name, $data, $format);
    }

    /**
     * Get a course by ID
     * 
     * @param int $id
     * @return object|null
     */
    public function get_course($id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE id = %d", $id);
        return $wpdb->get_row($query);
    }

    /**
     * Update a course
     * 
     * @param int $id
     * @param array $data
     * @return bool|int
     */
    public function update_course($id, $data) {
        global $wpdb;

        $data['updated_at'] = current_time('mysql');
        $where = array('id' => $id);
        $format = array('%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s');

        return $wpdb->update($this->table_name, $data, $where, $format);
    }

    /**
     * Delete a course
     * 
     * @param int $id
     * @return bool|int
     */
    public function delete_course($id) {
        global $wpdb;

        $where = array('id' => $id);
        return $wpdb->delete($this->table_name, $where);
    }

    /**
     * Get the weekly schedule
     * 
     * @param string $start_date
     * @return array
     */
    public function get_weekly_schedule($start_date) {
        global $wpdb;

        $end_date = date('Y-m-d', strtotime($start_date . ' +6 days'));
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE start_datetime BETWEEN %s AND %s", $start_date, $end_date);
        return $wpdb->get_results($query);
    }

    /**
     * Get the monthly schedule
     * 
     * @param string $start_date
     * @return array
     */
    public function get_monthly_schedule($start_date) {
        global $wpdb;

        $end_date = date('Y-m-d', strtotime($start_date . ' +1 month'));
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE start_datetime BETWEEN %s AND %s", $start_date, $end_date);
        return $wpdb->get_results($query);
    }

    /**
     * Check for course conflicts
     * 
     * @param string $start_datetime
     * @param string $end_datetime
     * @param int $room_number
     * @return bool
     */
    public function check_course_conflicts($start_datetime, $end_datetime, $room_number) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT COUNT(*) FROM $this->table_name WHERE room_number = %d AND ((start_datetime BETWEEN %s AND %s) OR (end_datetime BETWEEN %s AND %s))", $room_number, $start_datetime, $end_datetime, $start_datetime, $end_datetime);
        $count = $wpdb->get_var($query);

        return $count > 0;
    }

    /**
     * Get the schedule for a specific teacher
     * 
     * @param int $teacher_id
     * @return array
     */
    public function get_teacher_schedule($teacher_id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE teacher_id = %d", $teacher_id);
        return $wpdb->get_results($query);
    }

    /**
     * Export the planning to PDF
     * 
     * @param int $teacher_id
     */
    public function export_planning_to_pdf($teacher_id) {
        // Code to export planning to PDF
    }
}