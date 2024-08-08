$(function() {
    "use strict";

    // DataTable initialization
    $('#example').DataTable();

    // DataTable with buttons
    var table2 = $('#example2').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print']
    });

    // Append buttons container to the correct wrapper
    table2.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

    // DataTable with custom button (PDF in landscape format)
    var customTable = $('#customTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
        ]
    });

    // Append buttons container to the correct wrapper
    customTable.buttons().container().appendTo('#customTable_wrapper .col-md-6:eq(0)');
});
