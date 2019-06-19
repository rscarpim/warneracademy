'use strict';

let elems = document.querySelectorAll('.scrollspy');

let instances = M.ScrollSpy.init(elems, {
	throttle: 100,
	scrollOffset: 250,
	activeClass: 'active'
});




/* DIV Name. */
let ElCard 			= document.getElementById('toast-info');

/* Chips. */
let ElSkills 		= document.querySelectorAll('#chipsSkiills');

let ElPreferences = document.querySelectorAll('#chipsPreferences');

/* User ID. */
let vUserID 		= document.querySelector('#usu_id').value;





if (typeof (ElCard) != 'undefined' && ElCard != null) {

	/* Add the Effect. */
	setTimeout(function () {

		/* Add the Class to the Div. */
		ElCard.classList.add('animated fadeInUp');
	}, 5000);

	/* Remove the Div. */
	setTimeout(function () {

		ElCard.parentNode.removeChild(ElCard);
	}, 6000);
}




/****************************************************************************************************/
/* CHIPS OBJECTS*/

/* Funcao Global Populando o Chip AutoComplete Skills. */
PPopulateChips('/UserSkill/FGetSkills', 'ski_description', '/UserSkills/FGetAllSkills', 'sks_user_id', vUserID,  ElSkills, '/UserSkills/PSaveData');


/* Funcao Global Populando o Chip AutoComplete Course Preferences. */
PPopulateChips('/UserPreference/FGetPreference', 'pre_description', 'UserPreferences/FGetAllPreferences', 'pre_user_id', vUserID, ElPreferences, '/UserPreferences/PSaveData');













$(document).ready(function()
{

 

	/* Carrega a DataTable com as Informacoes dos Cursos Cadastrados do Usuario Selecionado.  */
	$('#TblMessages').DataTable({
		"processing": true,
		"serverSide": false,
		"paging": true,
		"lengthChange": false,
		"pageLength": 5,
		"ajax": {
			"url": '/UserMessages/FGetAllMessages',
			"data": { "pUserID": $('#usuID').val() },
			"type": "post",
			"dataSrc": "",
		},

		columnDefs: [
			{
				"targets": [0, 1],
				"orderable": false,
				"order": [],
			},
			{
				"targets": [2, 3, 4, 5],
				"orderable": false,
				"className": 'dt-body-center',
			 },
			{
				"targets": 4,
				"orderable": false,
				"data": null,
				render: function (d) {
					return "<button class='btn waves-effect waves-light green darken-1' id='btnEdit' data-id='" + d.not_id + "'>Edit</button>";
				},
			},
			{
				"targets": 5,
				"orderable": false,
				"data": null,
				render: function (d) {
					return "<button class='btn waves-effect waves-light red darken-1' id='btnDelete data-id='" + d.not_id + "'>Delete</button>";
				},
			},
			// {
			// 	"targets": 5,
			// 	"orderable": false,
			// 	"data": null,
			// 	render: function (d) {
			// 		return "<button class='btn waves-effect waves-light blue darken-1' id='btnLectures' data-id='" + d.cour_id + "'>Lectures</button>";
			// 	},
			// },
		],

		"columns": [

			{ "data": "not_Asdesc" },
			{ "data": "not_description" },
			{ "data": "not_created" },
			{ "data": "not_Asstatus" },
		],		
	});
	
	

	/*	Name			: PCallData 
	*	Objective		: Make's a $.ajax call to return data from the database and populate a autocomplete field.
	*	Autor			: Ricardo Scarpim
	*	Date Created	: 7/6/2018
	*	Date Updated 	:
	*	Return			: it's not a Function
	*/
	function PCallData($pUrl, $pFieldName, $pDataField, $pReturnData) 
	{
		
		$.ajax({

			url: $pUrl,
			type: 'GET',
			async: true,
			
			success: function(response){				
				
				let ObjData 	= {};
				let obj			= {};

				/* Se hourver um retorno, autocomplete ... */
				if($pReturnData)
				{
					
					/* Se nao for um objeto Vazio.  */
					if (!jQuery.isEmptyObject(response))
					{
						obj = JSON.parse(response);
						

						for (var i = 0; i < obj.length; i++) {

							ObjData[obj[i][$pDataField]] = null
						}

						/* Carregando o Autocomplete. */
						$('#' + $pFieldName).autocomplete({
							data: ObjData,
							onAutocomplete: function (res) {
								$('#' + $pFieldName).val(res);
							}
						});
					}
				}				
			}
		});		
	  };







	  
	  
	  /*******************************************************************************************************/
	  /*  */
	  /*******************************************************************************************************/

	  /* Quando pegar o foco no campo autocomplete, Carregar as Profissoes. */
	  $('#professional_headline').focus(function(){

		/* Carregar o AutoComplete. */
		PCallData('/Professional', 'professional_headline', 'prof_description', true);
	  });



	  $('#professional_headline').on('change', function () {
		  
		/* Se Existir um Conteudo.  */
		if ($(this).val() !== '') {

			/* Call the Stored Procedure para Salvar os Dados Cadastrais. */
			$.post('/Professional/FSaveProfession', { pProfession: $(this).val() }, function (res) {

				
			})
		}
	  });



	  /* Quando pegar o foco no campo autocomplete, Carregar os Idiomas.  */
	  $('#user_language').focus(function () {

		  /* Carregar o AutoComplete. */
		  PCallData('/Language', 'user_language', 'lan_description', true);
	  });



	  /* Ao Sair do Campo Login Info. Checar se o Login esta Disponivel */
	  $('#usu_login').on('blur', function(e)
	  {

		e.preventDefault();		  

		/* Se houver algo Digitado. */
		if($(this).val() !== '')
		{

			/* Compara o Valor Digitado para Verificar se Houve Mudanca.  */
			if($(this).val () !== $(this).attr('data-id')){

				$.ajax({
					url: '/Profile/FCheckUserData',
					data: 'user_login=' + $(this).val(),
					type: 'POST',
					async: true,

					success: function (res) {

						if (parseInt(res) === 1) {

							$('#msg-available').html(
								'<span class="red-text text-darken-4" '
								+ 'style="font-size: 12px;">This Login has been taken </span><i class="material-icons red-text text-darken-4 right">block</i>');

						} else {

							$('#msg-available').html(
								'<span class="green-text text-darken-4" '
								+ 'style="font-size: 12px;">Login Available </span><i class="material-icons green-text text-darken-4 right">check</i>');


							$('#usu_cur_password').focus();
						}
					}
				});					
			}else{

				/* E o Mesmo Valor, Limpar o Span com a Msg.*/
				$('#msg-available').html('');
			}		
		}else{

			/* Mensagem de que o Campo tem que ser Preenchido. */
			$('#msg-available').html(
				'<span class="red-text text-darken-4" '
				+ 'style="font-size: 12px;">This Field has to be Filed !</span><i class="material-icons red-text text-darken-4 right">block</i>');
				
			/* Focus */
			$(this).focus();
		}		  	
	  });


	  /* Ao Digitar do Campo que Verifica a Atual Password.  */
	  $('#usu_cur_password').on('keyup', function(){

		/* Verifica o Tamanho do Coteudo Digitado */
		if($(this).val().length >= 4)
		{

			/* Verifica se a Senha e Correta. */
			$.post('/UserCheckPassword/FCheckPassword',
				{
					pPassword: 	$('#usu_cur_password').val(),
				 	pEmail: $('#usu_cur_password').attr("data-id")
				}, function (res) {

					/* A Password foi Encontrada.*/
					if (parseInt(res) === 1) {

						/*Remove the Red Text Add the Green Text show Message Password Match. */
						FChangeStatus('msg-pass-match', true, 1);

						/* Habilitar Campos */
						$('#usu_new_password').	prop('disabled', false);
						$('#usu_password').		prop('disabled', false);

						$('#usu_new_password').focus();

						/* Habilitar botao salvar pois pode estar querendo trocar somente o user name. */
						$('#btnAccount').prop('disabled', false);
					}else{

						/* Add the Red Text with message Password didn't match. */
						FChangeStatus('msg-pass-match', false, 0);

						/* Desabilitar Campos */
						$('#usu_new_password').	prop('disabled', true);
						$('#usu_password').		prop('disabled', true);

						/* Desabilitar botao. */
						$('#btnAccount').prop('disabled', true);
					}					

				});			
			
		}else{

			/* Desabilitar Campos */
			$('#usu_new_password').	prop('disabled', true);
			$('#usu_password').		prop('disabled', true);
			
			/* */
			$('#msg-pass-match').html('');
		}
	  });




	  /* Ao Digitar a Nova Password Checar se Conferem */
	  $('#usu_password').on('keyup', function(){

		if( ($(this).val() !== '') && ($(this).val().length >= 4) )
		{

			/* Comparando */
			if ($(this).val() === $('#usu_new_password').val())
			{

				/* Mostra Span com a Msg. */
				FChangeStatus( 'msg-pass-correct', true, 3 );

				/* Habilita Botao Salvar */
				$('#btnAccount').prop('disabled', false);
			}else{

				/* Mostra Span com a Msg que Passwords nao Conferem*/ 
				FChangeStatus( 'msg-pass-correct', false, 4 );

				/* Desabilita Botao Salvar. */
				$('#btnAccount').prop('disabled', true);
			}
		}else{

			/* Limpando o span */
			$('#msg-pass-correct').html('');

			/* Desabilita Botao Salvar. */
			$('#btnAccount').prop('disabled', true);			
		}
	  })


	  /*
	  *		Name		: FChangeStatus.
	  *		Objective	: Change a <span> Text with the Parameter Message.
	  */
	  function FChangeStatus(vObject, vStatus, vTypeMsg)
	  {
		let vMsg = "";

		switch (vTypeMsg) {

			/* Password didn't match. */
			case 0:

				vMsg = "Password didn't match !!";
				break;

			/* Password Match  */
			case 1:

				vMsg = "Password Match";
				break;

			/* Password's Match */
			case 3:

				vMsg = "Password's Match";
				break;
			
			/* Password's didn't Match */
			case 4:

				vMsg = "Password's didn't Match !!";
				break;
		}



		switch (vStatus) 
		{

			/* Add the Red Alert.*/
			case false:

				/* Remove Green Alert. */
				$('#' + vObject).removeClass('green-text text-darken-2');

				/* Add Red Alert. */
				$('#' + vObject).html(vMsg + '<i class="tiny material-icons red-text text-darken-4 right">block</i> Check Password ').css('font-size', '12px').addClass('red-text text-darken-2');
				break;
		
			/* Add the Green Alert. */
			case true:

				/* Remove Red Alert.  */
				$('#' + vObject).removeClass('red-text text-darken-2');

				/* Add Green Alert. */
				$('#' + vObject).html(vMsg + '<i class="tiny material-icons green-text text-darken-4 right">check</i>').css('font-size', '12px').addClass('green-text text-darken-2');
				break;
		}

	  }



	  
});	



