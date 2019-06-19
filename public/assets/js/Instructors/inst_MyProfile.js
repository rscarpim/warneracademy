'use strict';

var elems = document.querySelectorAll('.fixed-action-btn');
var instances = M.FloatingActionButton.init(elems);

/* User ID. */
let vUserID = document.querySelector('#usu_id').value;

/* Chips. */
let ElProfessionalSkills = document.querySelector('#ProfessionalSkills');


/* Desabilitando. */
document.getElementById('picture-file').disabled = true;



/*******************************************************************************************/
/* Chamando Funcoes Globais. */
/*******************************************************************************************/
PPopulateChips('/ProfessionalSkill/FGetProfessionalSkill', 
                'pro_description', 
                '/ProfessionalSkills/FGetProfessionalSkills', 
                'pro_sks_user_id', 
                vUserID, 
                ElProfessionalSkills, 
                '/ProfessionalSkills/PSaveData');











/*******************************************************************************************/
/* Chamando Funcoes Locais. */
/*******************************************************************************************/

/* Verifica se Name First e name Last estao digitados.  */
const FCheckFields = () => {
    

    let vFirstName = document.querySelector('#usu_name_first').value;

    let vLastName = document.querySelector('#usu_name_last').value;

    if (vFirstName !== "" && vLastName !== "")

        document.getElementById('picture-file').disabled = false;
    else

        document.getElementById('picture-file').disabled = true;
};

 







/*******************************************************************************************/
/* Adicionando Eventos. */                
/*******************************************************************************************/

/* Ao Selecionar a Imagem, usar funcao que checa a extensao. */
document.querySelector('#picture-file').addEventListener('change', function (e) {    

    /* Checar se o caminho possui uma extensao valida.  */
    document.querySelector('#img-instructor').src = FCheckExtensionType(this);
});









/*  */
























$(document).ready(function () {


    $('input.count').characterCounter();
});