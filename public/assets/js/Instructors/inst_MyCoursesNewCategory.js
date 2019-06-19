'use strict';

document.addEventListener('DOMContentLoaded', function () {

    /* DIV Name. */
    let ElCard  = document.getElementById('card-alert');
    let ElToast = document.getElementById('toast-info');


    /* Se Existir um Card, esconde apos determinado tempo. */
    if (typeof (ElCard) !== 'undefined' && ElCard !== null) {

        /* Add the Effect. */
        setTimeout(function () {

            /* Add the Class to the Div. */
            ElCard.classList.add('fadeOutDown');
        }, 5000);

        /* Remove the Div. */
        setTimeout(function () {

            ElCard.parentNode.removeChild(ElCard);
        }, 6000);
    }


    


    /* Pegando Elementos pelo ID */
    let vSpanError = document.getElementById('ErrorMsg');




    /* Ao Sair do Campo Categoria Name, Verificar se a Mesma ja nao Existe. */
    document.getElementById('cat_description').addEventListener('blur', function (e) {
        
        e.preventDefault();       
       

        if (!FisEmpty(this.value)) {

            FCheckData('/MyCoursesNewCategory/FCheckCategory', { 'cat_description': this.value })
                .then(function (result) {
                    
                    /* Funcao que Mostra Msg de Erro ou Validade. */
                    FSetErrorFieldMsg(result, vSpanError);
                });
        }else{

            /* Default. */
            FSetErrorFieldMsg(null, vSpanError, (this.className === 'required')? true: false ); 
        }
    });




    
});