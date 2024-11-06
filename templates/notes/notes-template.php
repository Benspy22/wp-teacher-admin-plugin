<?php
if (!defined('ABSPATH')) {
    exit;
}

// Assuming you have a function to get students, subjects, and grades
$students = get_students();
$subjects = get_subjects();
$grades = get_grades();
?>

<div class="wrap">
    <h1>Gestion des Notes</h1>
    <h2 class="nav-tab-wrapper">
        <a href="#tab-list" class="nav-tab nav-tab-active">Liste des Notes</a>
        <a href="#tab-add" class="nav-tab">Ajouter une Note</a>
        <a href="#tab-stats" class="nav-tab">Statistiques</a>
        <a href="#tab-export" class="nav-tab">Exporter PDF</a>
    </h2>

    <div id="tab-list" class="tab-content">
        <h2>Liste des Notes</h2>
        <div class="filters">
            <select id="filter-class" class="form-control">
                <option value="">Filtrer par classe</option>
                <!-- Populate with classes -->
            </select>
            <select id="filter-student" class="form-control">
                <option value="">Filtrer par élève</option>
                <!-- Populate with students -->
            </select>
            <select id="filter-subject" class="form-control">
                <option value="">Filtrer par matière</option>
                <!-- Populate with subjects -->
            </select>
            <input type="date" id="filter-start-date" class="form-control" placeholder="Date de début">
            <input type="date" id="filter-end-date" class="form-control" placeholder="Date de fin">
            <button id="filter-button" class="button button-primary">Filtrer</button>
        </div>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Élève</th>
                    <th>Matière</th>
                    <th>Note</th>
                    <th>Date</th>
                    <th>Commentaires</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grades as $grade) : ?>
                    <tr>
                        <td><?php echo esc_html($grade->student_name); ?></td>
                        <td><?php echo esc_html($grade->subject); ?></td>
                        <td><?php echo esc_html($grade->grade_value); ?></td>
                        <td><?php echo esc_html($grade->grade_date); ?></td>
                        <td><?php echo esc_html($grade->comments); ?></td>
                        <td>
                            <a href="#" class="button button-secondary">Modifier</a>
                            <a href="#" class="button button-secondary">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="average-grade">
            <h3>Moyenne: <?php echo calculate_average_grade(); ?></h3>
        </div>
    </div>

    <div id="tab-add" class="tab-content" style="display:none;">
        <h2>Ajouter une Note</h2>
        <form id="add-grade-form" method="post" action="">
            <div class="form-group">
                <label for="student">Élève</label>
                <select id="student" name="student_id" class="form-control">
                    <?php foreach ($students as $student) : ?>
                        <option value="<?php echo esc_attr($student->id); ?>"><?php echo esc_html($student->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="subject">Matière</label>
                <select id="subject" name="subject" class="form-control">
                    <?php foreach ($subjects as $subject) : ?>
                        <option value="<?php echo esc_attr($subject->id); ?>"><?php echo esc_html($subject->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="grade">Note</label>
                <input type="number" id="grade" name="grade_value" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="comments">Commentaires</label>
                <textarea id="comments" name="comments" class="form-control"></textarea>
            </div>
            <button type="submit" class="button button-primary">Soumettre</button>
        </form>
    </div>

    <div id="tab-stats" class="tab-content" style="display:none;">
        <h2>Statistiques</h2>
        <!-- Add statistics content here -->
    </div>

    <div id="tab-export" class="tab-content" style="display:none;">
        <h2>Exporter PDF</h2>
        <button id="export-pdf-button" class="button button-primary">Exporter les Notes en PDF</button>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        $('.nav-tab').click(function(e) {
            e.preventDefault();
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.tab-content').hide();
            $($(this).attr('href')).show();
        });

        $('#filter-button').click(function() {
            // Add filter functionality here
        });

        $('#add-grade-form').submit(function(e) {
            e.preventDefault();
            // Add form submission functionality here
        });

        $('#export-pdf-button').click(function() {
            // Add export to PDF functionality here
        });
    });
</script>