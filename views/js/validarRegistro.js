
/* ***************************************************************
    VARIABLES 
 *************************************************************** */
const nombre = document.getElementById('usuarioRegistro');
const password = document.getElementById('passwordRegistro');
const email = document.getElementById('emailRegistro');
const btnRegistrar = document.getElementById('registrar');

// invocamos el Event listener
eventListeners();


function eventListeners(){
    // Inicio de la aplicación y deshabilitación del submit en el form
    document.addEventListener("DOMContentLoaded",diableBtn);

    // campos del formulario
    nombre.addEventListener("keyup", validarCampo);
    password.addEventListener("keyup", validarCampo);
    email.addEventListener("keyup", validarCampo);
    
}

function diableBtn(e){
    btnRegistrar.disabled = true;
}


function validarCampo(e){


    // validamos la longitud del campo y que no venga vacio
    validarLongitud(this);

    // validar que sean email 
    if(this.type === 'text'){
        validarNombreUsuario(this);
    }else if (this.type === 'email'){
        validarEmail(this);
    }else if (this.type === 'password'){
        validarPassword(this);
    }


    // obtener la clase error en el DOM
    let errores = document.querySelectorAll('.error');

    // validar si los valores estan vacios
    if(nombre.value != "" && password.value != "" && email.value != "")
    {
        // si la longitud de los errores es igual a cero desactiva el boton
        if(errores.length === 0){
            btnRegistrar.disabled = false;
        }
    }
    else {
        btnRegistrar.disabled = true;
    }

}


function validarLongitud(campo){

    // console.log(campo.value.length);

    // agregar border color a las los input si estan llenos  o vacios

    if(campo.value.length > 0) {
        campo.style.borderColor = 'green';
        campo.classList.remove('error');
        
    }else {
        campo.style.borderColor = 'red';
        campo.classList.add('error');
        // document.querySelector("label[for='usuarioRegistro']").innerHTML += "<br>Escriba por favor menos de 6 caracteres.";

    }

}


/* ***************************************************************
VALIDAR USUARIO REGISTRO 
 *************************************************************** */

function validarNombreUsuario(){
    console.log('dentro del input name');
}


/* **************************** FIN DE VAIDAR REGSITRO **************************/


/* ***************************************************************
VALIDAR PASSWORD REGISTRO 
 *************************************************************** */


function validarPassword(campo){

    // console.log('dentro del input pasword');

    // let expresion = /^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/;
    const contrasenia = campo.value;

        if(campo.value != ''){

            campo.style.borderColor = 'green';
            campo.classList.remove('error');
           
        }
        else{        
            campo.style.borderColor = 'red';
                campo.classList.add('error');
        }
    }

   


/* **************************** FIN DE VAIDAR usuario REGSITRO **************************/


/* ***************************************************************
VALIDAR PASSWORD REGISTRO 
 *************************************************************** */


function validarEmail(campo){

    const correo = campo.value;
    // console.log(mensaje);
    if(correo.indexOf('@') > -1)
    {
        campo.style.borderColor = 'green';
        campo.classList.remove('error');
    }
    else{
        campo.style.borderColor = 'red';
        campo.classList.add('error');
    }

}


/* **************************** FIN DE VAIDAR usuario REGSITRO **************************/