<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Notes_Manager
 * Handles all functionalities related to student grades
 */
class Notes_Manager {

    // Table name
    private $table_name;

    /**
     * Constructor to initialize the class
     */
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'teacher_grades';
    }

    /**
     * Add a new grade
     * 
     * @param int $student_id
     * @param string $subject
     * @param float $grade_value
     * @param string $grade_date
     * @param string $comments
     * @return bool|int
     */
    public function add_grade($student_id, $subject, $grade_value, $grade_date, $comments) {
        global $wpdb;

        $data = array(
            'student_id' => $student_id,
            'subject' => $subject,
            'grade_value' => $grade_value,
            'grade_date' => $grade_date,
            'comments' => $comments,
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql')
        );

        $format = array('%d', '%s', '%f', '%s', '%s', '%s', '%s');

        return $wpdb->insert($this->table_name, $data, $format);
    }

    /**
     * Get a grade by ID
     * 
     * @param int $id
     * @return object|null
     */
    public function get_grade($id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE id = %d", $id);
        return $wpdb->get_row($query);
    }

    /**
     * Update a grade
     * 
     * @param int $id
     * @param array $data
     * @return bool|int
     */
    public function update_grade($id, $data) {
        global $wpdb;

        $data['updated_at'] = current_time('mysql');
        $where = array('id' => $id);
        $format = array('%d', '%s', '%f', '%s', '%s', '%s', '%s');

        return $wpdb->update($this->table_name, $data, $where, $format);
    }

    /**
     * Delete a grade
     * 
     * @param int $id
     * @return bool|int
     */
    public function delete_grade($id) {
        global $wpdb;

        $where = array('id' => $id);
        return $wpdb->delete($this->table_name, $where);
    }

    /**
     * Get all grades for a student
     * 
     * @param int $student_id
     * @return array
     */
    public function get_student_grades($student_id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE student_id = %d", $student_id);
        return $wpdb->get_results($query);
    }

    /**
     * Calculate the average grade for a student
     * 
     * @param int $student_id
     * @return float
     */
    public function calculate_average($student_id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT AVG(grade_value) FROM $this->table_name WHERE student_id = %d", $student_id);
        return (float) $wpdb->get_var($query);
    }

    /**
     * Get grades by class (subject)
     * 
     * @param string $subject
     * @return array
     */
    public function get_grades_by_class($subject) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE subject = %s", $subject);
        return $wpdb->get_results($query);
    }

    /**
     * Export grades to PDF
     * 
     * @param int $student_id
     */
    public function export_grades_to_pdf($student_id) {
        // Code to export grades to PDF
    }
}