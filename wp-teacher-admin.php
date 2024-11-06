<?php
/**
 * Plugin Name: Gestion Administrative Enseignants
 * Plugin URI: https://github.com/Benspy22/wp-teacher-admin-plugin
 * Description: Plugin de gestion des notes, planning et compétences pour enseignants
 * Version: 1.0.0
 * Author: Benjamin Debruijne
 * License: GPL v2 or later
 * 
 * Features:
 * - Grade Management System (notes)
 * - Course Planning Calendar (planning)
 * - Skills Tracking System (compétences)
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

class WP_Teacher_Admin {

    // Plugin version
    const VERSION = '1.0.0';

    // Plugin path
    const PLUGIN_PATH = __DIR__;

    // Plugin URL
    const PLUGIN_URL = plugin_dir_url(__FILE__);

    // Singleton instance
    private static $instance = null;

    /**
     * Constructor to initialize the plugin
     */
    private function __construct() {
        // Initialize the plugin
        $this->init();
    }

    /**
     * Get the singleton instance of the plugin
     * 
     * @return WP_Teacher_Admin
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Initialize the plugin by setting up hooks and loading dependencies
     */
    public function init() {
        // Register activation and deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        // Add hooks and filters
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
    }

    /**
     * Activation hook to create necessary tables
     */
    public function activate() {
        global $wpdb;

        // SQL to create tables
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$wpdb->prefix}teacher_grades (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            student_id mediumint(9) NOT NULL,
            grade float NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;

        CREATE TABLE {$wpdb->prefix}teacher_courses (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            course_name varchar(255) NOT NULL,
            course_date datetime NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;

        CREATE TABLE {$wpdb->prefix}teacher_skills (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            student_id mediumint(9) NOT NULL,
            skill_name varchar(255) NOT NULL,
            skill_level int NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    /**
     * Deactivation hook to clean up if necessary
     */
    public function deactivate() {
        // Code to run on plugin deactivation
    }

    /**
     * Enqueue CSS and JS assets
     */
    public function enqueue_assets() {
        wp_enqueue_style('wp-teacher-admin-style', self::PLUGIN_URL . 'assets/css/style.css', array(), self::VERSION);
        wp_enqueue_script('wp-teacher-admin-script', self::PLUGIN_URL . 'assets/js/script.js', array('jquery'), self::VERSION, true);
    }

    /**
     * Add admin menu for the plugin
     */
    public function add_admin_menu() {
        add_menu_page(
            'Gestion Administrative Enseignants',
            'Gestion Enseignants',
            'manage_options',
            'wp-teacher-admin',
            array($this, 'admin_page'),
            'dashicons-welcome-learn-more'
        );

        add_submenu_page(
            'wp-teacher-admin',
            'Gestion des Notes',
            'Notes',
            'manage_options',
            'wp-teacher-admin-grades',
            array($this, 'grades_page')
        );

        add_submenu_page(
            'wp-teacher-admin',
            'Planification des Cours',
            'Planning',
            'manage_options',
            'wp-teacher-admin-courses',
            array($this, 'courses_page')
        );

        add_submenu_page(
            'wp-teacher-admin',
            'Suivi des Compétences',
            'Compétences',
            'manage_options',
            'wp-teacher-admin-skills',
            array($this, 'skills_page')
        );
    }

    /**
     * Display the main admin page for the plugin
     */
    public function admin_page() {
        echo '<div class="wrap"><h1>Gestion Administrative Enseignants</h1></div>';
    }

    /**
     * Display the grades management page
     */
    public function grades_page() {
        echo '<div class="wrap"><h1>Gestion des Notes</h1></div>';
    }

    /**
     * Display the courses planning page
     */
    public function courses_page() {
        echo '<div class="wrap"><h1>Planification des Cours</h1></div>';
    }

    /**
     * Display the skills tracking page
     */
    public function skills_page() {
        echo '<div class="wrap"><h1>Suivi des Compétences</h1></div>';
    }
}

// Initialize the plugin
WP_Teacher_Admin::getInstance();