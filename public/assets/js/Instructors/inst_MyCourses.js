$(document).ready(function() {
  
    /* Carrega a DataTable com as Informacoes dos Cursos Cadastrados do Usuario Selecionado.  */
    $('#TblCourses').DataTable({
        "processing"    : true,
        "serverSide"    : false,
        "paging"        : true,
        "lengthChange"  : false,
        "pageLength"    : 5,
        "ajax": {
            "url": '/MyCourses/FGetAllCourses',
            "data": { "pUserID": $('#usuID').val() },
            "type": "post",
            "dataSrc": "",
        },

        "columns": [

            { "data": "cat_description" },
            { "data": "cour_title" },
            { "data": "cour_featured" },
        ],

        rowCallback: function (row, data) {

            /* Muda a cor do Texto conforme o Status. */
            if (data.cour_featured == 'Yes') {
                $(row).find('td:eq(2)').css('color', 'green');
            }
        },
        
        columnDefs: [
            {
                "targets": [0, 1], 
                "orderable": false,
                "order": [],
            }, 
            {
                "targets": 2,
                "orderable": false,
                "className": 'dt-body-center',
            },           
            {
                "targets": 3,
                "orderable": false,
                "data":null,
                render: function (d) {
                    return "<button class='btn waves-effect waves-light green darken-1' id='btnEdit' data-id='" + d.cour_id + "'>Edit</button>";
                },                
            },
            {
                "targets": 4,
                "orderable": false,
                "data": null,
                render: function (d) {
                    return "<button class='btn waves-effect waves-light red darken-1' id='btnDelete data-id='" + d.cour_id + "'>Delete</button>";
                },
            },
            {
                "targets": 5,
                "orderable": false,
                "data": null,
                render: function (d) {
                    return "<button class='btn waves-effect waves-light blue darken-1' id='btnLectures' data-id='" + d.cour_id + "'>Lectures</button>";
                },
            },            
        ]
    });



   
})