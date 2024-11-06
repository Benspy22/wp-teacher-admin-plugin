<?php
if (!defined('ABSPATH')) {
    exit;
}

// Assuming you have functions to get classes and courses
$classes = get_classes();
$courses = get_courses();
?>

<div class="wrap">
    <h1>Gestion du Planning</h1>

    <div class="row">
        <div class="col-md-9">
            <div id="calendar"></div>
        </div>
        <div class="col-md-3">
            <div class="sidebar">
                <h2>Prochains Cours</h2>
                <ul id="upcoming-courses">
                    <?php foreach ($courses as $course) : ?>
                        <li>
                            <strong><?php echo esc_html($course->course_title); ?></strong><br>
                            <?php echo esc_html($course->start_datetime); ?> - <?php echo esc_html($course->end_datetime); ?><br>
                            <?php echo esc_html($course->class_name); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <h2>Filtres Rapides</h2>
                <select id="filter-class" class="form-control">
                    <option value="">Filtrer par classe</option>
                    <?php foreach ($classes as $class) : ?>
                        <option value="<?php echo esc_attr($class->id); ?>"><?php echo esc_html($class->name); ?></option>
                    <?php endforeach; ?>
                </select>

                <h2>Exporter le Planning</h2>
                <button id="export-planning-button" class="button button-primary">Exporter en PDF</button>
            </div>
        </div>
    </div>

    <div id="course-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="course-form" method="post" action="">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter/Modifier un Cours</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="course-title">Titre du Cours</label>
                            <input type="text" id="course-title" name="course_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="class-name">Classe</label>
                            <select id="class-name" name="class_name" class="form-control">
                                <?php foreach ($classes as $class) : ?>
                                    <option value="<?php echo esc_attr($class->id); ?>"><?php echo esc_html($class->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start-datetime">Date et Heure de Début</label>
                            <input type="datetime-local" id="start-datetime" name="start_datetime" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end-datetime">Date et Heure de Fin</label>
                            <input type="datetime-local" id="end-datetime" name="end_datetime" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="room-number">Salle de Classe</label>
                            <input type="text" id="room-number" name="room_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="button button-primary">Soumettre</button>
                        <button type="button" class="button button-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                <?php foreach ($courses as $course) : ?>
                {
                    title: '<?php echo esc_js($course->course_title); ?>',
                    start: '<?php echo esc_js($course->start_datetime); ?>',
                    end: '<?php echo esc_js($course->end_datetime); ?>',
                    color: '<?php echo esc_js(get_subject_color($course->subject)); ?>',
                    description: '<?php echo esc_js($course->description); ?>'
                },
                <?php endforeach; ?>
            ],
            eventRender: function(event, element) {
                element.attr('title', event.description);
                element.tooltip();
            }
        });

        $('#filter-class').change(function() {
            // Add filter functionality here
        });

        $('#course-form').submit(function(e) {
            e.preventDefault();
            // Add form submission functionality here
        });

        $('#export-planning-button').click(function() {
            // Add export to PDF functionality here
        });
    });
</script>