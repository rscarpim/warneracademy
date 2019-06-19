

$(document).ready(function () {

    $('.tabs').tabs();

    /* Carrega a DataTable com as Informacoes dos Cursos Cadastrados do Usuario Selecionado.  */
    $('#TblUsers').DataTable({
        "processing": true,
        "serverSide": false,
        "paging": true,
        "order": [],
        "lengthChange": false,
        "pageLength": 8,
        "ajax": {
            "url": '/User/FGetAllUsers',
            "type": "post",
            "dataSrc": "",
            "serverSide": false
        },
        "columnDefs": [
            {
                "targets": [1, 2, 3],
                "orderable": false,
            },
            {
                "targets": 0,
                "orderable": false,
                "className": 'dt-body-center',
            },
            {
                "targets": 3,
                "orderable": false,
                "className": 'dt-body-center',
            },
            {
                "targets": 4,
                    "orderable": false,
                        "data": null,
                            "className": 'dt-body-center',
                                render: function (d) {
                                    
                                    //var vSetCrypto = FSetCrypt(d.us_id);

                                    return "<a href='/User/update/' class='btn waves-effect waves-light green darken-1' id='btnEdit' data-id='' style='width:80px;'>Edit</a>";
                                },
            },
            
        ],
        "columns": [

            { "data": "usu_status" },
            { "data": "usu_login" },
            { "data": "usu_name_first" },
            { "data": "usu_level_id"}
        ],

        
        rowCallback: function (row, data) {

            /* Muda a cor do Texto conforme o Status. */
            if (data.us_status_display == 'Inactive') {

                $(row).find('td:eq(0)').css('color', 'red');
            }
        }
    })



    // {
    //     "targets": 4,
    //         "orderable": false,
    //             "data": null,
    //                 "className": 'dt-body-center',
    //                     render: function (d) {

    //                         var vSetCrypto = FSetCrypt(d.us_id);

    //                         return "<a href='/User/update/" + vSetCrypto + "' class='btn waves-effect waves-light green darken-1' id='btnEdit' data-id='" + vSetCrypto + "' style='width:80px;'>Edit</a>";
    //                     },
    // },
    // {
    //     "targets": 5,
    //         "orderable": false,
    //             "data": null,
    //                 "className": 'dt-body-center',
    //                     render: function (d) {

    //                         return "<a class='btn waves-effect waves-light red darken-1' id='btnDelete' data-id='" + d.us_id + "' style='width:80px;'>Delete</a>";
    //                     },
    // }




});