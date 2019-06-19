/*
*
*       JAVASCRIPT SECTION
*
*/
'use strict';

document.getElementById('btnRegister').disabled = true;


/* DIV Name. */
let ElCard = document.getElementById('card-alert');


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



/*
*	Nome		: FDisableEnable.
*	Objetivo	: Desabilitar / Habilitar input baseado na classe validate.
*	Data		: 9/25/2018
*	Autor		: Ricardo Scarpim
*	@Params		:
*		pSetType: boolean true = desabilitar false = habilitar.
*/
const FDisableEnable = (pClassName, pSetType) => {

	const inputs = document.querySelectorAll('input.' + pClassName);
	inputs.forEach(input => input.disabled = pSetType);
};



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
	

	if(pPassword.value !== ""){		

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
		} else{

			 ElmSpanStrength.setAttribute("style", "color: green");

			return ElmSpanStrength.innerHTML = "Password strength Strong";
		}
	}	
}




/*
*	Nome		: FSearchData
*	Objetivo	: Atraves de um fetch enviar dados 'POST' para pagina PHP.
*	Data		: 9/25/2018
*	Autor		: Ricardo Scarpim
*	@Params		:
*		pUrl	: Url responsavel pela pesquisa no Servidor php.
*		pFIeld	: Campo pelo qual a pesquisa sera realizada.
*		pContent: Conteudo da pesquisa.
*/
async function FSearchData (pUrl, pField, pContent){

	let formdata = new FormData();

	formdata.append(pField, pContent);

	let response = await fetch(pUrl, {
		method: 'POST',
		body: formdata
	});

	let data = await response.json();

	return data;
}





/* Ao digitar algo no Campo de usu_login e sair do campo, Checar se o Mesmo ja nao possui cadastro */
document.querySelector('#usu_login').addEventListener('blur', function () {
	
	if(this.value !== ""){

		let Elem 			= document.getElementById('txtValid'); 
		let ElmBtnSubmit 	= document.getElementById('btnRegister');

		/* Pesquisando pelo Login, verifica se ainda esta disponivel. */
		FSearchData('/User/FCheckLogin', "usu_login", this.value)
			.then(data => {

				/* Se resultado === false nao existe este Login. */
				if (data === false) {

					Elem.innerHTML = "Login available";

					/* Funcao para Mudar a Cor do input verde*/
					Elem.setAttribute("style", "color: green");
				} else {

					Elem.innerHTML = "Login has already been taken";

					/* Funcao para Mudar a Cor do input vermelho*/
					Elem.setAttribute("style", "color: red");

					/* Desabilitar botao salvar. */
					ElmBtnSubmit.disabled = true;

					this.focus();
				}
			});			
	}
});




/* Ao digitar a Senha. */
document.querySelector('#password').addEventListener('keyup', function () {

	FCheckStrength(this.value);	
});




/* Ao Redigitar a Senha Verificar se Conferem. */
document.querySelector('#usu_password').addEventListener('keyup', function () {
	
	if(this.value !== "")
	{

		let ElmPassword 	= document.getElementById('password').value;
		let ElmSpanMsg		= document.getElementById('span-msg');
		let ElmBtnSubmit 	= document.getElementById('btnRegister');

		

		/* Senhas Conferem. */
		if(this.value === ElmPassword )
		{
			
			ElmSpanMsg.innerHTML = "Passwords Match";
			ElmSpanMsg.setAttribute("style", "color: green");
			
			/* checa se senha tem pelo menos 6 caracteres.  */
			(ElmPassword.length >= 6) ?  ElmBtnSubmit.disabled = false : ElmBtnSubmit.disabled = true;

		}else
		{


			ElmSpanMsg.innerHTML = "Passwords didn't Match";
			ElmSpanMsg.setAttribute("style", "color: red");

			/* checa se senha tem pelo menos 6 caracteres.  */			
			ElmBtnSubmit.disabled = true;
		}
	}

});