
/* DIV Name. */
var ElCard = document.getElementById('card-alert');


if (typeof (ElCard) != 'undefined' && ElCard != null)
{

    /* Add the Effect. */
    setTimeout(function () {

        /* Add the Class to the Div. */
        ElCard.classList.add('fadeOutDown');        
    }, 5000);

    /* Remove the Div. */
    setTimeout(function (){

        ElCard.parentNode.removeChild(ElCard);
    }, 6000);
}






$(document).ready(function () {
    M.updateTextFields();
}); 