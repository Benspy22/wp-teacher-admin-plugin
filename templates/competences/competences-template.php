<?php
if (!defined('ABSPATH')) {
    exit;
}

// Assuming you have functions to get students, skills, and skill categories
$students = get_students();
$skills = get_skills();
$skill_categories = get_skill_categories();
?>

<div class="wrap">
    <h1>Suivi des Compétences</h1>

    <div class="row">
        <div class="col-md-9">
            <h2>Tableau de Bord des Compétences</h2>
            <div class="filters">
                <select id="filter-category" class="form-control">
                    <option value="">Filtrer par catégorie</option>
                    <?php foreach ($skill_categories as $category) : ?>
                        <option value="<?php echo esc_attr($category->id); ?>"><?php echo esc_html($category->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="skills-dashboard">
                <?php foreach ($students as $student) : ?>
                    <div class="student-skills">
                        <h3><?php echo esc_html($student->name); ?></h3>
                        <?php foreach ($skills as $skill) : ?>
                            <div class="skill">
                                <span><?php echo esc_html($skill->name); ?></span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr($skill->progress); ?>%;" aria-valuenow="<?php echo esc_attr($skill->progress); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="skill-status <?php echo esc_attr($skill->status); ?>"><?php echo esc_html($skill->status); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-3">
            <h2>Validation des Compétences</h2>
            <form id="validate-skill-form" method="post" action="">
                <div class="form-group">
                    <label for="student">Élève</label>
                    <select id="student" name="student_id" class="form-control">
                        <?php foreach ($students as $student) : ?>
                            <option value="<?php echo esc_attr($student->id); ?>"><?php echo esc_html($student->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="skill">Compétence</label>
                    <select id="skill" name="skill_id" class="form-control">
                        <?php foreach ($skills as $skill) : ?>
                            <option value="<?php echo esc_attr($skill->id); ?>"><?php echo esc_html($skill->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Niveau d'Acquisition</label>
                    <select id="status" name="status" class="form-control">
                        <option value="non acquis">Non acquis</option>
                        <option value="en cours">En cours</option>
                        <option value="acquis">Acquis</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comments">Commentaires</label>
                    <textarea id="comments" name="comments" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="validation-date">Date de Validation</label>
                    <input type="date" id="validation-date" name="validation_date" class="form-control" required>
                </div>
                <button type="submit" class="button button-primary">Valider</button>
            </form>

            <h2>Fonctionnalités Supplémentaires</h2>
            <button id="export-pdf-button" class="button button-primary">Exporter PDF</button>
            <button id="view-history-button" class="button button-secondary">Historique des Validations</button>
        </div>
    </div>

    <div id="charts">
        <h2>Graphiques de Progression</h2>
        <canvas id="progress-chart"></canvas>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $('#filter-category').change(function() {
            // Add filter functionality here
        });

        $('#validate-skill-form').submit(function(e) {
            e.preventDefault();
            // Add form submission functionality here
        });

        $('#export-pdf-button').click(function() {
            // Add export to PDF functionality here
        });

        $('#view-history-button').click(function() {
            // Add view history functionality here
        });

        var ctx = document.getElementById('progress-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Non acquis', 'En cours', 'Acquis'],
                datasets: [{
                    label: 'Progression des Compétences',
                    data: [10, 20, 30], // Example data
                    backgroundColor: ['#dc3545', '#ffc107', '#28a745']
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>