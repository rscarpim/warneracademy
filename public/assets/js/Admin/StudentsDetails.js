
$(document).ready(function(){


    M.updateTextFields();


 







    $('.modal').modal({

        onOpenStart: function(){            

            $('#btnSendingCoupon').attr('disabled', true);

            /* Compara Valores nas Tables  */
            $('#tblCouponsList > tbody > tr').each(function (){                
                
                /* Linha de Origem */
                let vOrigem = $(this).closest('tr').find('td:eq(0)').text().trim();
                
                $('#tblCoupons > tbody > tr').each(function () {

                    /* Compara Linha de Origem com Linha de Destino. */
                    if (vOrigem == $(this).closest('tr').find('td:eq(0)').text().trim()) $(this).remove();
                });
            });
        }
    });
    
   

    /* Ao Clicar no Botal Enviar Coupon */
    $('#btnSendCoupon').on('click', function(){

        /* Un-check all combox */
        $('input[type="radio"]').prop('checked', false);

        $('#mdCourses').modal('open');       
    });


    /* Habiitar / Desabilitar o Botao Enviar.  */
    $('input[type="radio"]').on('change', function(){         

        $('#btnSendingCoupon').attr('disabled', (this.checked) ? false: true);        
    });




    /* Ao Clicar para Enviar o Coupon*/
    $('#btnSendingCoupon').on('click', function(e){

        e.preventDefault();

        let vCourseID           = $("input[type='radio']:checked").attr('data-id');
        
        let vUserID             = $("input[type='radio']:checked").attr('data-user-id');

        let vCourseDescription  = $("input[type='radio']:checked").attr('data-cour-desc');

        /* Se Houver um ID Valido. */
        if ((vCourseID !== '') || (vCourseID !== 'undefined')) {

            /* Enviando Dados Atraves do POST para o Controller*/
            $.post('/Students/SendCoupon', { courID: vCourseID, userID: vUserID }, function (returnedData) 
            {
                
                /* Successfully Executed.  */
                if(returnedData.trim() === 'executed'){

                    let d = new Date();
                    
                    let twoDigitMonth = ((d.getMonth().length + 1) === 1) ? (d.getMonth() + 1) : '0' + (d.getMonth() + 1);  
                    
                    let currentDate = twoDigitMonth + "/" + d.getDate() + "/" + d.getFullYear();                        
                    
                    let vHTML = '';

                    vHTML += '<tr>';

                        vHTML += '<td>' + vCourseDescription + '</td>';
                        vHTML += '<td class="center">' + currentDate +'</td>';
                        vHTML += '<td class="center"><span class="green-text">0</span></td>'
                        vHTML += '<td class="center" width="15%"><span class="green-text">ACTIVE</span><i class="material-icons right green-text">open_in_browser</i></td >';
                        vHTML += '<td></td></td>';
                    vHTML += '</tr>';

                    /* Adicionar os Dados na Ultima Linha da Tabela. */
                    $("table tbody").append(vHTML);                   
                     
                }
            });            
        }        
    });


    /* Ao Clicar para Deletar o Coupon.  */
    $('.btnDeleteCoupon').on('click', function(){

        let vCouponID = $(this).attr('data-id');

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {

                $.post('/Students/DeleteCoupon', { couponID: vCouponID }, function (returnedData) {
                    
                    if (returnedData.trim() === 'executed'){                        

                        swal({
                            title: 'Deleted!',
                            text: 'The coupon has been deleted.',
                            type: 'success',
                            timer: 1800
                        })
                    }
                   
                });          
                
                /* Remove Table row. */
                $(this).parents('tr').first().remove();
            }
        })
    });










    function FReturnData()
    {

        $.post('/Students/FListUser', { userID: 1 }, function (returnedData) {
            
            return returnedData;
        });
        

    }


    /* Tabela com os Coupons */
    var vTbCoupons = $('#TblCouponsTest').DataTable({
    
        "dom": '<"toolInfo">frtip',
        "processing": true,
        "serverSide": false,
        "paging": true,
        "lengthChange": false,
        "pageLength": 5,
        "ajax":{
            "url": '/Students/FGetAllCoupons',
            "data": { "pUserID": $('#usu_id').val() },
            "type": "POST",
            "dataSrc": "",
            "serverSide": false,
            "createdRow": function (row, data) {
                $(row).attr('data-id', data.cou_id)
            }                        
        },
        "columns": [

            { "data": "cour_name" },
            { "data": "cou_coupon" },
            { "data": "dt_generated" },
            { "data": "days_expiration" },
            { "data": "cou_status" }
        ], 
        columnDefs: [
            {
                "targets": [1, 2, 3, 4],
                className: 'dt-body-center', 
                "orderable": false,
            },
            { 
                "targets": 5,  
                "className": 'dt-body-center',
                "data": null,
                "defaultContent": "<button class='btnDeleteCoupon btn waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow'>Delete</button>",
                createdCell: function (td, rowData) {
                    console.log(rowData);
                    $(td).attr('id', rowData.cou_id);
                }
            }
        ]      
    });




    /* Customizando a Table de coupons. */
    $("div.toolInfo").html();




    $('#TblNotifications').DataTable({

        "dom": '<"toolbar">frtip',
        "processing":true,
        "serverSide":false,
        "paging": true,
        "lengthChange": false,
        "pageLength": 5,
        "ajax":{
            "url": '/Students/FGetAllUsers',
            "data": { "userID": $('#usu_id').val()},
            "type": "POST",
            "dataSrc": "",
            "serverSide": false,
            "createdRow": function (row, data) {
                $(row).attr('id', data.usu_id)}

        },
        columnDefs: [
            {
                "targets": [3,4],
                "className": 'dt-body-center',
                "data": null,
                "defaultContent": "<button class='btn waves-effect waves-light green darken-1'>Edit</button>",
                "targets": 5,                
                createdCell: function (td, rowData) {
                    $(td).attr('data-id', rowData.not_id); 
                }                
            }
        ],
        "columns": [
            
            { "data": "not_Asdesc" },
            { "data": "not_description" },
            { "data": "cour_name" },
            { "data": "not_created"},
            { "data": "not_Asstatus" }
        ],
        rowCallback: function (row, data) {

            /* Muda a cor do Texto conforme o Status. */
            if (data.not_Asstatus == 'Active') {
                $(row).find('td:eq(4)').css('color', 'green');
            }
        }
    });


    /* Adiciona o Titulo e o Botao Nova Notificacao. */
    $("div.toolbar").html(

            '<div class="row"> '                
            
                + '<div class="col l12" style="padding-top:19px; margin-left:0px;">'

                    + '<h6 class="grey-text">List of Notifications/Messages.</h6>'
                + '</div>'                    
            + '</div>');

    /* Ao clicar pegar o Codigo da Notificacao */
    $('#TblNotifications tbody').on('click', 'td', function () {
        
        /* Pegando o Codigo da Noti */
        let vNotificacao = $(this).attr('data-id');

        console.log(vNotificacao);
    });








    




  




});