/* Funcoes Definidas em JavaScript. */
'use strict';



const FSetErrorFieldMsg = (pResult, pSpanMsg, pIsRequired = false) => {
    
    /* Conforme o Retorno */
    switch (pResult) {

        case false:

            /* Mostrando o Span*/
            pSpanMsg.setAttribute('style', 'display: block; color: green; font-size: 13px;');

            /* Trocando o Tituld. */
            pSpanMsg.innerHTML = '<i class="material-icons right">check</i> Is Available.';            
            break;

        case null:

            if(pIsRequired) {

                /* Mostrando o Span*/
                pSpanMsg.setAttribute('style', 'display: block; color: red; font-size: 13px;');

                /* Trocando o Tituld. */
                pSpanMsg.innerHTML = '<i class="material-icons right">error</i> This is a Required Field.';

            }else
            {
                /* Escondendo o Span */
                pSpanMsg.setAttribute('style', 'display: none;');

                pSpanMsg.innerHTML = "";
            }
            break;
    
        default:

            /* Mostrando o Span*/
            pSpanMsg.setAttribute('style', 'display: block; color: red; font-size: 13px;');

            /* Trocando o Tituld. */
            pSpanMsg.innerHTML = '<i class="material-icons right">error</i> Has been taken already';
            break;
    }    
}





/*
*	Nome		: FCheckStrength.
*	Objetivo	: Checar a forca da password.
*	Data		: 9/25/2018
*	Autor		: Ricardo Scarpim
*	@Params		:
*		pPassord: Password digita a ser checada. 
*/
const FCheckStrength = (pPassword) => {

    //initial strength
    let strength = 0;

    let toReturn = "";

    let ElmSpanStrength = document.getElementById('span-strength');


    if (pPassword.value !== "") {

        //if the password length is less than 6, return message.
        if (pPassword.length < 10) {

            ElmSpanStrength.setAttribute("style", "color: red");

            return ElmSpanStrength.innerHTML = 'Too short Minimum 10 characters.';
        }


        if (pPassword.length > 7)
            strength++;


        //if password contains both lower and uppercase characters, increase strength value
        if (pPassword.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))
            strength++;

        //if it has one special character, increase strength value
        if (pPassword.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
            strength++;

        //if it has two special characters, increase strength value
        if (pPassword.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/))
            strength++;

        /* Pontuacao Menor do que 2  */
        if (strength < 2) {

            ElmSpanStrength.setAttribute("style", "color: red");

            return ElmSpanStrength.innerHTML = 'Password strength Weak';
        } else if (strength === 2) {

            ElmSpanStrength.setAttribute("style", "color: blue");

            return ElmSpanStrength.innerHTML = 'Password strength Good';
        } else {

            ElmSpanStrength.setAttribute("style", "color: green");

            return ElmSpanStrength.innerHTML = "Password strength Strong";
        }
    }
}




const FisEmpty = (e) => {
    
    switch (e) {
        case "":
        case 0:
        case "0":
        case null:
        case false:
        case typeof this == "undefined":
            return true;
        default:
            return false;
    }
}



async function PAutoComplete(pFormData) 
{

    let response = await fetch(pUrlSaveData, {
        method: 'POST',
        body: pFormData
    });

    let data = await response.json();
}




async function FCheckData(pUrl, pFormData)
{
    
    let formData = new FormData();

    /* Getting Field Name and Field Values*/
    for (let [Field, Value] of Object.entries(pFormData)) {

        /* Populating the FormData Array. */
        formData.append(Field, Value);
    }

    let response = await fetch(pUrl, {
        method: 'POST',
        body: formData
    });
    
    return await response.json();
}





window.FCheckExtensionType = (pElement) => {

    /* Validas extensoes.  */
    let vExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.svg)$/i;

    /* Pegando a ultima ocorrencia da / */
    let vFilePath = pElement.value.split('\\').pop().split('/').pop();


    /* Se nao for uma extensao valida.*/
    if (!vExtensions.exec(vFilePath)) {

        /* Limpando o Campo com o Nome do Arquivo */
        pElement.value = "";

        return false;
    }
    
    let vUrl = pElement.getAttribute('data-src');

    /* Setando a Imagem de Fundo do Avatar. */    
    return vUrl + 'assets/images/' + vFilePath;
}






/* Funcao Global para Carregar Dados no Objeto AutoComplete. */
/*  Nome        : FReturnAutoCompleteData.
*   Objetivo    : Popula AutoComplete com Dados Vindos do Banco.
*   Parametros  :
*       pUrl        : Url com o Caminho do Controller para Retorno dos Dados Json.
*       pDataField  : Campo que sera Mostrado dentro do AutoComplete/
*       pElement    : Elemento do Tipo AutoComplete.
*/
window.FReturnAutoCompleteData = (pUrl, pDataField, pElement) => {   

    fetch(pUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(res => res.json())
        .then(response => {

            /* Se houver um Retorno em forma de Objeto */
            if (Object.keys(response).length !== 0) {

                let ObjData = [];
                
                /* Cria o Array de Dadoa para o AutoComplete */
                response.forEach(response => {

                    ObjData[response[pDataField]] = null
                });

                /* Inicializando o Objeto. */
                M.Autocomplete.init(pElement, {
                    data: ObjData,
                    limit: 5,
                    minLength: 1
                });
            }
        })
};



const FPopulateAutoComplete = async (pUrl, pData, pElement, pFieldDescription) => {

    let formData = new FormData();

    /* Getting Field Name and Field Values*/
    for (let [Field, Value] of Object.entries(pData)) {

        /* Populating the FormData Array. */
        formData.append(Field, Value);
    }


    let response = await fetch(pUrl, {
        method: 'POST',
        body: formData
    });

   
    let data = await response.json();

    let ObjData = [];

    /* Cria o Array de Dadoa para o AutoComplete */
    data.forEach(response => {

        ObjData[response[pFieldDescription]] = null
    });
    


    /* Inicializando o Objeto. */
    M.Autocomplete.init(pElement, {
        data: ObjData,
        limit: 5,
        minLength: 1
    });
}




/*	Name			: PCallData 
*	Objective		: Make's a $.ajax call to return data from the database and populate a autocomplete field.
*	Autor			: Ricardo Scarpim
*	Date Created	: 7/6/2018
*	Date Updated 	:
*	Return			: it's not a Function
*/
function PCallData($pUrl, pSearchData, $pFieldName, $pDataField, $pReturnData) {


    if (!jQuery.isEmptyObject(pSearchData)) {

        let formData = new FormData();

        /* Getting Field Name and Field Values*/
        for (let [Field, Value] of Object.entries(pSearchData)) {

            /* Populating the FormData Array. */
            formData.append(Field, Value);
        }
    }



    $.ajax({

        url: $pUrl,
        type: 'POST',
        async: true,

        success: function (response) {

            let ObjData = {};
            let obj = {};
            

            /* Se hourver um retorno, autocomplete ... */
            if ($pReturnData) {

                /* Se nao for um objeto Vazio.  */
                if (!jQuery.isEmptyObject(response)) {

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





const FPopulateCombo = async (pUrl, pDataObj, pElement, pPrefix, pPrefixValue = null) => {

    let formData = new FormData();

    /* Object. */
    if (Object.keys(pDataObj).length)
    { 

        /* Getting Field Name and Field Values*/
        for (let [Field, Value] of Object.entries(pDataObj)) {

            /* Populating the FormData Array. */
            formData.append(Field, Value);
        }
    } 

    const response = await fetch(pUrl,{
        method: 'POST',
        body: formData
    });

    const Data = await response.json();
    

    /* Getting the Element to be Populated */
    let pNewElement = document.getElementById(pElement);

    /* Cleaning. */
    pNewElement.options.length = 0;    

    pNewElement.options[pNewElement.options.length] = new Option('Choose your option', "", false, false);
    
    /* Disabling. */
    pNewElement.options[0].disabled = true;


    /* Populando o Elemento Combobox */
    for (let [Field, Value] of Object.entries(Data)) {

        /* Verifica qual o Tipo de Value a Combo ira Aceitar, string ou ID. */
        let vValue = (pPrefixValue !== null ) ? pPrefixValue: pPrefix + '_id';
        
        /* Populating. */
        pNewElement.options[pNewElement.options.length] = new Option(Value[pPrefix + '_description'], Value[vValue], false, false);
    }    

    return (Data.length === 0)? true: false;
}









/*
*   Name        : PPopulaChips.
*   Objetivo    : Popular o Componente Chips com Dados vindos do Banco de Dados, Assim como o Autocomplete.
*   Parametros  :
*       pUrl            : Url que Contem o Caminho para a Tabela que Traz os Dados para Popular o AutoComplete.
*       pFieldData      : Nome do Campo que ira ser Populado
*       pUrlContente    : Url que Contem o Caminho para a Tabela que Traz os Dados Salvos no Banco.
*       Element         : Instancia do Elemento que Sera Populado
*   Data        : 9/14/2018
*   Autor       : Ricardo Scarpim
*   Retorno     :
*/
window.PPopulateChips = (pUrl, pFieldData, pUrlContent, pField, pContent, Element, pUrlSaveData) => 
{
    

    /* Retorna a Table com os Dados Cadastrais que Populam o Autocomplete. */
    fetch(pUrl, {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(res => res.json())
        .then(response => {


                let ObjData = [];

                /* Cria o Array de Dadoa para o AutoComplete */
                response.forEach(response => {

                    ObjData[response[pFieldData]] = null
                });

                
                async function FSearchData() {                    
                    
                    if (pContent !== "") {
                        
                        let formDt = new FormData();

                        formDt.append(pField, pContent);
                        

                        let response = await fetch(pUrlContent, {
                            method: 'POST',
                            body: formDt
                        });

                        
                        let data = await response.json();
                        let ObjDataContent = [];


                        /* Cria o Array de Dadoa para o AutoComplete */
                        data.forEach(data => {

                            ObjDataContent.push({ tag: data[pFieldData], id: pContent })
                        });  
                        
                        
                            
                        /* Inicializando o Chip. */
                        M.Chips.init(Element, {

                            placeholder: 'Type information',
                            autocompleteOptions: {
                                data: ObjData,
                                limit: 5,
                                minLength: 1
                            },

                            data: ObjDataContent,

                            onChipDelete: function (e, data) {                                

                                let vContent = data.textContent.substr(0, data.textContent.length - 5).trim();                                

                                /* Chamar a Stored Procedure para Realizar a Exclusao no Banco. */
                                PSaveData(3, vContent);
                            },

                            onChipAdd: function (e, data) {

                                let vContent = data.textContent.substr(0, data.textContent.length - 5).trim();
                                
                                /* Se houver um Conteudo.  */
                                if(vContent.trim() !== "")
                                {

                                    /* Chamar a Stored Procedure para Realizar a Inclusao no Banco. */
                                    PSaveData(1, vContent);
                                }                            
                            }
                        });

                        async function PSaveData(pTypeCRUD, pDescription)
                        {

                            let formData = new FormData();

                            /* Adicionando os Campos para a Inclusao ou Exclusao.*/
                            formData.append('pType', pTypeCRUD);  
                            formData.append('pDescription', pDescription);
                            formData.append('pUserID', pContent)                            

                            let response = await fetch(pUrlSaveData, {
                                method: 'POST',
                                body: formData
                            });

                            let data = await response.json();
                        }                        
                    }
                } FSearchData();  
        })
        .catch(error => console.error('Error:', error));
}





function validateDate(dateStr) {
    
    const regExp = /^(\d\d?)\/(\d\d?)\/(\d{4})$/;
    let matches = dateStr.match(regExp);
    let isValid = matches;
    let maxDate = [0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    if (matches) {
        const month = parseInt(matches[1]);
        const date = parseInt(matches[2]);
        const year = parseInt(matches[3]);

        isValid = month <= 12 && month > 0;
        isValid &= date <= maxDate[month] && date > 0;

        const leapYear = (year % 400 == 0)
            || (year % 4 == 0 && year % 100 != 0);
        isValid &= month != 2 || leapYear || date <= 28;
    }

    return isValid
}