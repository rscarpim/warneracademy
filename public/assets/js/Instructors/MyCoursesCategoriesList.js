'use-strict';


document.addEventListener('DOMContentLoaded', function () {


    document.getElementById('TblCourses').addEventListener('click', function (e)
    {

        e.preventDefault();

        /* Ao Clicar no Botao para Editar a Categoria.  */
        if (e.target && e.target.id === 'btnEdit') {

            console.log(e.target.getAttribute('data-id'));

        }
    })

    










});







$(document).ready(function() {

    
  
    /* Carrega a DataTable com as Informacoes dos Cursos Cadastrados do Usuario Selecionado.  */
    $('#TblCourses').DataTable({
        "processing"    : true,
        "serverSide"    : false,
        "paging"        : true,
        "lengthChange"  : false,
        "pageLength"    : 5,
        "order": [],
        "ajax": {
            "url": '/MyCoursesCategoriesList/FGetAllCategories',
            "type": "post",
            "dataSrc": "",
        },

        "columns": [

            { "data": "cat_description" },
            { "data": "totalSub"},
            { "data": null},
        ],
        
        columnDefs: [
            {
                "targets": [0,1], 
                "orderable": false,
                "order": [],                
            },
            
            {
                "targets": [1],
                "className": 'dt-body-center',
            },
                       
            {
                "targets": 2,
                "orderable": false,
                "data":null,
                render: function (d) {
                    return "<a href='#modal1' style='width:80px;' class='btn waves-effect waves-light green darken-1 modal-trigger' id='btnEdit' data-id='" + d.cat_id + "'>Edit</a>";
                },                
            },
            {
                "targets": 3,
                "orderable": false,
                "data": null,
                render: function (d) {
                    return "<button style='width:80px;' class='btn waves-effect waves-light red darken-1' id='btnDelete data-id='" + d.cat_id + "'>Delete</button>";
                },
            },            
        ]
    });



   
})