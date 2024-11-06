<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Competences_Manager
 * Handles all functionalities related to student skills tracking
 */
class Competences_Manager {

    // Table name
    private $table_name;

    /**
     * Constructor to initialize the class
     */
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'teacher_skills';
    }

    /**
     * Add a new skill
     * 
     * @param int $student_id
     * @param int $skill_id
     * @param string $skill_name
     * @param string $skill_category
     * @param string $status
     * @param string $validation_date
     * @param int $validated_by
     * @param string $comments
     * @return bool|int
     */
    public function add_skill($student_id, $skill_id, $skill_name, $skill_category, $status, $validation_date, $validated_by, $comments) {
        global $wpdb;

        $data = array(
            'student_id' => $student_id,
            'skill_id' => $skill_id,
            'skill_name' => $skill_name,
            'skill_category' => $skill_category,
            'status' => $status,
            'validation_date' => $validation_date,
            'validated_by' => $validated_by,
            'comments' => $comments,
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql')
        );

        $format = array('%d', '%d', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s');

        return $wpdb->insert($this->table_name, $data, $format);
    }

    /**
     * Get a skill by ID
     * 
     * @param int $id
     * @return object|null
     */
    public function get_skill($id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE id = %d", $id);
        return $wpdb->get_row($query);
    }

    /**
     * Update the status of a skill
     * 
     * @param int $id
     * @param string $status
     * @return bool|int
     */
    public function update_skill_status($id, $status) {
        global $wpdb;

        $data = array(
            'status' => $status,
            'updated_at' => current_time('mysql')
        );
        $where = array('id' => $id);
        $format = array('%s', '%s');

        return $wpdb->update($this->table_name, $data, $where, $format);
    }

    /**
     * Delete a skill
     * 
     * @param int $id
     * @return bool|int
     */
    public function delete_skill($id) {
        global $wpdb;

        $where = array('id' => $id);
        return $wpdb->delete($this->table_name, $where);
    }

    /**
     * Validate a skill
     * 
     * @param int $id
     * @param string $validation_date
     * @param int $validated_by
     * @return bool|int
     */
    public function validate_skill($id, $validation_date, $validated_by) {
        global $wpdb;

        $data = array(
            'status' => 'acquis',
            'validation_date' => $validation_date,
            'validated_by' => $validated_by,
            'updated_at' => current_time('mysql')
        );
        $where = array('id' => $id);
        $format = array('%s', '%s', '%d', '%s');

        return $wpdb->update($this->table_name, $data, $where, $format);
    }

    /**
     * Get all skills for a student
     * 
     * @param int $student_id
     * @return array
     */
    public function get_student_skills($student_id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE student_id = %d", $student_id);
        return $wpdb->get_results($query);
    }

    /**
     * Get the progress of skills for a class
     * 
     * @param string $class_name
     * @return array
     */
    public function get_class_skills_progress($class_name) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE class_name = %s", $class_name);
        return $wpdb->get_results($query);
    }

    /**
     * Generate a skills report
     * 
     * @param int $student_id
     * @return string
     */
    public function generate_skills_report($student_id) {
        // Code to generate a skills report
    }

    /**
     * Export skills to PDF
     * 
     * @param int $student_id
     */
    public function export_skills_to_pdf($student_id) {
        // Code to export skills to PDF
    }
}