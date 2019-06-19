"use strict";

document.addEventListener('DOMContentLoaded', function () {


    /* Setando Variaveis dos OBJETOS do DOM  */
    let ElTitle         = document.getElementById('cour_title');

    let vElCategory     = document.getElementById('cour_category');
    let vElSubCategory  = document.getElementById("cour_subcategory"); 

    let vElLinkName     = document.getElementById('cour_link_name');
    let vElSubLinkName  = document.getElementById('cour_sublink_name');

    let vElBtnAddLink   = document.getElementById('btnAddLink');


    /* SPANS. */
    let vSpanMsgAvailable       = document.getElementById('span-msg-available');
    let vSpanMsgTitleAvailable  = document.getElementById('msg-span-title-available');

    /* Inicializando Componentes. */


    /* Collapsible. */
    let ElCollapsible   = document.querySelectorAll('.collapsible');
    let InstCollapsible = M.Collapsible.init(ElCollapsible);


    /* Button. */
    let ElFabButton     = document.querySelectorAll('.fixed-action-btn');
    let InstFabButton   = M.FloatingActionButton.init(ElFabButton); 
  


    /* Desabilitando Componentes. */
    vElLinkName.disabled        = true;
    vElSubLinkName.disabled     = true;
    vElBtnAddLink.disabled      = true;



    /* Escondendo Componentes.  */



    /* Carregando ComboBoxex. */
    FPopulateCombo('/CourseLevel/FGetAllLevels', {}, 'cour_level', 'lev');

    FPopulateCombo('/CourseStatus/FGetAll', {}, 'cour_status', 'sta');

    FPopulateCombo('/Categories/FGetAllCategories', {}, 'cour_category', 'cat');









    /******************************************************************************/
    /* Trabalhando com os Elementos da DOM Evento CHANGE */
    /******************************************************************************/

    /* Adicionando o Evento ao Entrart no AutoComplete para Trazer as Sub-Categorias Conforme a Categoria pre-selecionada*/
    vElCategory.addEventListener('change', function (e){        
        
        /* Se Existir algo Selecionado na ComboBox. */
        if (this.selectedIndex !== 0){

            FPopulateCombo('/Categories/FGetAllWhere', { 'category_id': this.value }, 'cour_subcategory', 'sub')
            .then(function(result){
                
                /* Habilita / Desabilita. */
                vElSubCategory.disabled     = result;

                (result === true) ? (function () 
                    { 
                        vElSubCategory.options.length = 0; 
                        vElSubCategory.options[vElSubCategory.options.length] = new Option('Choose your option', "", false, false); }) 
                        (vElSubCategory.options.length = 0)
                    : false;
            });
        }else
        {

            /* Disable Combobox. */
            vElSubCategory.disabled     = true;
        }   
    });



    /* Quando Selecionar uma Sub-Categoria. */
    vElSubCategory.addEventListener('change', function (e) {
   
        /* Se Existir algo Selecionado na ComboBox. */
        if (this.selectedIndex !== 0) {

            /* Pegando os Valores. */
            let vCategoryID     = vElCategory.value;
            let vSubCategoryID  = vElSubCategory.value;

            /* Habilitando Botao para criacao de link. */
            vElBtnAddLink.disabled = false;
         
            FPopulateCombo('/Links/FGetAllWhere', { 'category_id': vCategoryID, 'sub_category_id': vSubCategoryID }, 'cour_link_name', 'lik', 'lik_description')
                .then(function (result) {
                    
                    /* Habilita / Desabilita. */
                    vElLinkName.disabled    = result;                                        

                    (result === true) ? (function () {
                        vElLinkName.options.length = 0;
                        vElLinkName.options[vElLinkName.options.length] = new Option('Choose your option', "", false, false);
                    })
                        (vElLinkName.options.length = 0)
                        : false;                    
                })
        }
    });




    /* Ao selecionar um Link Valido Existente.  */
    vElLinkName.addEventListener('change', function (e) {
        
        vElSubLinkName.disabled = (this.value !== "") ? false: true;       
    })









    /******************************************************************************/
    /* Trabalhando com os Elementos da DOM Evento CLICK */
    /******************************************************************************/
    vElBtnAddLink.addEventListener('click', function (e) {

        e.preventDefault();

        swal({
            title: 'Creating a new Link Name.',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Create',
            showLoaderOnConfirm: true,
            preConfirm: (Thisvalue) => {                
                
                async function FSearch () {

                    let formData = new FormData();

                    /* Adicionando os Campos para a Inclusao ou Exclusao.*/
                    formData.append('category_id', vElCategory.value);
                    formData.append('sub_category_id', vElSubCategory.value);
                    formData.append('lik_description', Thisvalue);

                    let response = await fetch('/Links/FCheckNewLink', {
                        method: 'POST',
                        body: formData
                    });

                    let data = await response.json();

                    /* Se Retornar False campo NAO esta cadastrado. */
                    if(data === 'success')
                    {

                        /* Pegando os Valores. */
                        let vCategoryID     = vElCategory.value;
                        let vSubCategoryID  = vElSubCategory.value;
                        
                        
                        /* Saving the Data*/
                        swal({
                            title: 'Created Successfully',
                            type: 'success',
                            timer: 3000
                        });

                        /*Recarrega a Combo. */
                        FPopulateCombo('/Links/FGetAllWhere', { 'category_id': vCategoryID, 'sub_category_id': vSubCategoryID }, 'cour_link_name', 'lik')
                            .then(function (result) {

                                /* Se a combo estiver desabilitada. */
                                vElLinkName.disabled    = result;
                                
                                vElSubLinkName.disabled = result; 
                                
                                /* Setar o Item na Combobox. */
                                vElLinkName.selectedIndex = [...vElLinkName.options].findIndex (option => option.text === Thisvalue);                            
                            })
                    }else
                    {
                        /* Error Trying to Saving the Data. */
                        swal({
                            title: 'Error',
                            text: 'This Link already exists.',
                            type: 'error'
                        })                        
                    }
                }FSearch();  

            },
            inputValidator: (value) => {
                return !value && 'You need to write something!'
            },
            allowOutsideClick: false
        })
    });










    /******************************************************************************/
    /* Trabalhando com os Elementos da DOM Evento BLUR */
    /******************************************************************************/

    /* Checando o Titulo do Curso.  */
    ElTitle.addEventListener('blur', function (e) {

        e.preventDefault();

        if (!FisEmpty(this.value))
        {

            FCheckData('/MyCoursesNew/FCheckTitle', {  'cour_title': this.value })
                .then(function(result){

                    /* Se o Titulo nao Existir.*/
                    if(result === false)
                    {
                        
                        /* Mostrando o Span*/
                        vSpanMsgTitleAvailable.setAttribute('style', 'display: block; color: green; font-size: 13px;');

                        /* Trocando o Tituld. */
                        vSpanMsgTitleAvailable.innerHTML = '<i class="material-icons">check</i> This Title is Available.';                        
                    }else
                    {

                        /* Mostrando o Span*/
                        vSpanMsgTitleAvailable.setAttribute('style', 'display: block; color: red; font-size: 13px;');

                        /* Trocando o Tituld. */
                        vSpanMsgTitleAvailable.innerHTML = '<i class="material-icons">error</i> This Title has been taken already.';

                        /* Focus. */
                        ElTitle.focus();                         
                    }
                })
        }        
    })



    /* Ao Digitar SubLinkName verificar se ja nao possui cadastro.  */
    vElSubLinkName.addEventListener('blur', function (e) {

        e.preventDefault();

        if (!FisEmpty(this.value))
        {

            FCheckData('/MyCoursesNew/FCheckNewCourse', {  'category_id':          vElCategory.value, 
                                                           'sub_category_id':      vElSubCategory.value,
                                                           'lik_description':      vElLinkName.value,
                                                           'cour_sublink_name':    vElSubLinkName.value })
                .then(function (result) { 

                    /* Se o Curso nao Existir. */                
                    if(result === false)
                    {

                        /* Mostrando o Span*/
                        vSpanMsgAvailable.setAttribute('style', 'display: block; color: green; font-size: 13px;');

                        /* Trocando o Tituld. */
                        vSpanMsgAvailable.innerHTML = '<i class="material-icons">check</i> This Category is Available.';
                    }else
                    {

                        /* Mostrando o Span*/
                        vSpanMsgAvailable.setAttribute('style', 'display: block; color: red; font-size: 13px;');

                        /* Trocando o Tituld. */
                        vSpanMsgAvailable.innerHTML = '<i class="material-icons">error</i> This Category has been taken already.';

                        /* Focus. */
                        vElSubLinkName.focus();                    
                    }
                });

        }else
        {
         
            /* Mostrando o Span*/
            vSpanMsgAvailable.setAttribute('style', 'display: block; color: red; font-size: 13px;');
            
            /* Message to Fill the Required Field.*/
            vSpanMsgAvailable.innerHTML = '<i class="material-icons">error</i> Please fill out this Required Information.';

            /* Focus. */
            vElSubLinkName.focus();
        }
        
    })













   


});







$(document).ready(function(){


    $('select').formSelect();

    




    

})