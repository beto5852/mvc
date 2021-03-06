











/* ***************************************************************
    VALIDAR USUARIO EXISTENTE CON AJAX y JQUERY
 *************************************************************** */
    // usuario no existe


/* var usuarioExistente = false;



//iniciamos JQUEy con $ y luegp pasamos una funcion anonima al change
$("#usuarioRegistro").change(function() {

    var usuario = document.getElementById('usuarioRegistro');

    // console.log('usuario',usuarioAjax);

    // instanciando con FormData  le permiten compilar un conjunto de pares clave/valor para enviar mediante XMLHttpRequest
    var datos = new FormData(); 

    // añadimos campos a la instancia usando el método append
    datos.append("validarUsuario", usuario);

    $.ajax({
        url: "views/modulos/ajax.php", // archivo al que le enviaremos la peticion
        method: "POST", //envimos los datos por medio de post
        data: datos,  // datos que enviaremos al archivo ajax
        cache: false, //mandar cache limpia
        contentType: false, // tipo de contenido
        processData: false,
        success: function(respuesta){
            // console.log(respuesta);

            if(respuesta == 0)
            {
                $("label[for='usuarioRegistro'] span").html('<div class="invalid-feedback">Este usuario Ya existe en la base.</div>');

                usuarioExistente = true;
            }
            else {
                $("label[for='usuarioRegistro']").html('usuario');
                usuarioExistente = false;
            }



        } //nos devolvera la repuesta
    });
});


 */

/* ***************************************************************
    FIN NVALIDAR USUARIO EXISTENTE CON AJAX 
 *************************************************************** */



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
    document.addEventListener("DOMContentLoaded",disableBtn);

    // campos del formulario
    nombre.addEventListener("keyup", validarCampo);
    password.addEventListener("keyup", validarCampo);
    email.addEventListener("keyup", validarCampo);
    
}

function disableBtn(e){
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

function validarNombreUsuario(campo){
    // console.log('dentro del input name');
    const usuario = campo.value;
    const datos = new FormData();

    datos.append("validarUsuario", usuario);

    //instanciamos la comunicacion para crear el objeto
    const xhr = new XMLHttpRequest();

    // abrimos la conexión
    xhr.open('POST','views/modulos/ajax.php',true);

    //una vez que carga 
    xhr.onload =  function(){
        //status 200:correcto  |  403: prohibido  | 404: No encontrado
        if(this.status === 200){
            
            document.getElementById('userAjax').innerHTML = this.responseText;
        }
    }
    console.log(campo.value)
    //enviar el request

    xhr.send(datos);


    
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
                
        document.querySelector("label[for='passwordRegistro'] span").innerHTML += '<div class="valid-feedback">Correcto</div>';
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



// validacion de bootstrap 4

/* function validateBS4(){
    // Disable form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
}

  $(function(){
    validateBS4();
  }); */