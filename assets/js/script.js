jQuery(document).ready(function($) {
    // Gestionnaire de notes
    function sortTable(table, column, order) {
        var rows = table.find('tbody tr').get();
        rows.sort(function(a, b) {
            var A = $(a).children('td').eq(column).text().toUpperCase();
            var B = $(b).children('td').eq(column).text().toUpperCase();
            if (A < B) {
                return order === 'asc' ? -1 : 1;
            }
            if (A > B) {
                return order === 'asc' ? 1 : -1;
            }
            return 0;
        });
        $.each(rows, function(index, row) {
            table.children('tbody').append(row);
        });
    }

    $('.sortable').click(function() {
        var table = $(this).parents('table').eq(0);
        var rows = table.find('tbody tr').get();
        var column = $(this).index();
        var order = $(this).hasClass('asc') ? 'desc' : 'asc';
        sortTable(table, column, order);
        $(this).toggleClass('asc desc');
    });

    $('#filter-button').click(function() {
        var classFilter = $('#filter-class').val();
        var studentFilter = $('#filter-student').val();
        var subjectFilter = $('#filter-subject').val();
        var startDate = $('#filter-start-date').val();
        var endDate = $('#filter-end-date').val();

        // Add filter functionality here
    });

    $('#add-grade-form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success
            },
            error: function(response) {
                // Handle error
            }
        });
    });

    function calculateAverage() {
        var total = 0;
        var count = 0;
        $('.grade-value').each(function() {
            total += parseFloat($(this).text());
            count++;
        });
        var average = total / count;
        $('#average-grade').text(average.toFixed(2));
    }

    calculateAverage();

    // Gestionnaire de planning
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        events: [
            // Load events dynamically
        ],
        eventDrop: function(event, delta, revertFunc) {
            // Handle event drag & drop
        },
        eventClick: function(event) {
            // Handle event click for quick edit
        }
    });

    $('#filter-class').change(function() {
        // Add filter functionality here
    });

    $('#course-form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success
            },
            error: function(response) {
                // Handle error
            }
        });
    });

    $('#export-planning-button').click(function() {
        // Add export to PDF functionality here
    });

    // Gestionnaire de compétences
    $('#filter-category').change(function() {
        // Add filter functionality here
    });

    $('#validate-skill-form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success
            },
            error: function(response) {
                // Handle error
            }
        });
    });

    function updateProgressBars() {
        $('.progress-bar').each(function() {
            var progress = $(this).data('progress');
            $(this).css('width', progress + '%');
        });
    }

    updateProgressBars();

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

    $('#export-pdf-button').click(function() {
        // Add export to PDF functionality here
    });

    $('#view-history-button').click(function() {
        // Add view history functionality here
    });
});