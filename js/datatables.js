"use strict";

$("#table-1").dataTable({
  dom: 'Bfrtip',
  buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
  ]
});

$("#table-2").dataTable({
  dom: 'Bfrtip',
  buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
  ]
});

$("#table-3").dataTable({
  dom: 'Bfrtip',
  buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
  ]
});


$("#table-4").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [2, 3] }
  ]
});

$("#table-5").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [2, 3] }
  ]
});


$("#table-6").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [2, 3] }
  ]
});
