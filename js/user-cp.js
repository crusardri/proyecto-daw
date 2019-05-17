var testEmail = ["test@test.test", "ivan@maldonado.es", "gmail@halfonso.com"]
var testUsers = ["test", "ivan", "halfonso"]



/**
* Crea un mensaje debajo de un boxed-input
* 
* @param String selector     Selector css donde se va a poner el mensaje
* @param String message      Contenido del mensaje
* @param boolean success     true si es un mensaje correcto, false si es un mensaje de error
*/
function generateMsg(selector, message, success){
    let cssClass = "error"
    if(success){
        cssClass = "success"
    }
    $("label"+selector+" + .input-box-msg").remove()
    $("label"+selector).after("<div class='input-box-msg "+cssClass+"'>"+message+"</div>");
}
/**
* Borra cualquier mensaje de informacion bajo un campo boxed-input
* 
* @param String selector Selector css donde se va borrar el mensaje
*/
function removeMsg(selector){
    $("label"+selector+" + .input-box-msg").remove()
}


/**
* Comprueba si la longitud del nombre tiene 4 caracteres o mas
*
* @param String username    Nombre de usuario
* @return boolean true      si contiene 4 caracteres o mas
* @return boolean false     si contiene menos de 4 caracteres
*/
function checkUsernameLenght(username){
    if(username.length >= 4){
        return true;
    }
    return false;
}
/**
* Hace un Ajax contra el servidor y comprueba si el nombre de usuario esta disponible
*
* @param String username    Nombre de usuario
* @return boolean true      si esta disponible
* @return boolean false     si no esta disponible
*/
function checkAjaxUsernameAvailability(username){
  //return !testUsers.some((x)=>{return x.toLowerCase() == username.toLowerCase()}); 
    return new Promise((resolve, reject)=>{
        $.ajax({
            url: "Classes/UserController.php",
            method: "GET",
            data: {check_username: username},
            dataType: "html"
        }).done((d)=>{
            if(d == "DISPONIBLE"){
                resolve(true);
            }else{
                resolve(false);
            }
        })
    })
  
}
/**
* Hace un Ajax contra el servidor y comprueba si el email esta disponible
*
* @param String email       Correo electronico
* @return boolean true      si esta disponible
* @return boolean false     si no esta disponible
*/
function checkAjaxEmailAvailability(email){
    //return !testEmail.some((x)=>{return x.toLowerCase() == email.toLowerCase()})
    return new Promise((resolve, reject)=>{
        $.ajax({
            url: "Classes/UserController.php",
            method: "GET",
            data: {check_email: email},
            dataType: "html"
        }).done((d)=>{
            if(d == "DISPONIBLE"){
                resolve(true);
            }else{
                resolve(false);
            }
        })
    })
}
/**
* Comprueba si la longitud de la contraseña tiene 6 caracteres o mas
* 
* @param String password    contraseña a comprobar
* @return boolean true      si contiene 6 caracteres o mas
* @return boolean false     si contiene menos de 6 caracteres
*/
function checkPasswordLenght(password){
    if(password.length >= 6){
        return true;
    }
    return false;
}
/**
* Comprueba si las contraseñas coinciden antes de registrarse
* 
* @param String password          contraseña
* @param String repeatPassword    confirmacion de la contraseña
* @return boolean true            si concide
* @return boolean False           si no coincide
*/
function checkPasswordMatch(password, repeatPassword){
    if(password == repeatPassword){
        return true;
    }
    return false;
}
/**
* Comprueba si el correo electronico esta bien formateado
*
* @param String email       Correo electronico
* @return boolean True      si es correcto
* @return boolean False     si no es correcto
*/
function checkEmailFormat(email){
    var validate = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return validate.test(email.toLowerCase());
    
}
/**
* Comprueba el nombre de usuario y genera los mensajes de error
*
* @return boolean true     Si el usuario esta correctamente declarado
* @return boolean false    Si el usuario no esta correctamente declarado
*/
function checkUsername(){
    let username = $("#username input").val();
    if(username.length == 0){
        generateMsg("#username", "Este campo es obligatorio.");
        return false;
    }else if(!checkUsernameLenght(username)) {
        generateMsg("#username", "El nombre de usuario requiere 4 carácteres o mas.");
        return false;
    } else {
        removeMsg("#username");
        return true;
    }
}
/**
* Comprueba el nombre de usuario y genera los mensajes de error
*
*/
function checkUsernameAvailability(){
    let username = $("#username input").val();
    $("#username .button > span").text("Comprobando");
    if(checkUsername()){
        checkAjaxUsernameAvailability(username).then((r)=>{
            if(r){
                generateMsg("#username", "El nombre de usuario esta disponible.", true);
            } else {
                generateMsg("#username", "El nombre de usuario no esta disponible.");
            }
            $("#username .button > span").text("Comprobar");
        })
        
    }else {
        $("#username .button > span").text("Comprobar");
    }
}
/**
* Comprueba el email y genera los mensajes de error
*
*/
function checkEmailAvailability(){
    let email = $("#email input").val();
    $("#email .button > span").text("Comprobando");
    if(checkEmail()){
        checkAjaxEmailAvailability(email).then((r)=>{
            if(r){
                generateMsg("#email", "El Correo Electrónico esta disponible.", true);
            } else {
                generateMsg("#email", "El Correo Electrónico no esta disponible.");
            }
            $("#email .button > span").text("Comprobar");
        });
    }else {
        $("#email .button > span").text("Comprobar");
    }
}
/**
* Comprueba si la contraseña cumple los requisitos minimos y genera los mensaje sde error
*
* @return boolean true     Si la contraseña esta correctamente declarada
* @return boolean false    Si la contraseña no esta correctamente declarada
*/
function checkPassword(){
    let password = $("#password input").val();
    if(password.length == 0){
        generateMsg("#password", "Este campo es obligatorio.");
        return false;
    }else if(!checkPasswordLenght(password)){
        generateMsg("#password", "La contraseña debe contener 6 caracteres o mas.");
        return false;
    }else {
        removeMsg("#password");
        return true;
    }
}
/**
* Comprueba si confirmar contraseña es igual a la anterior y genera los mensajes de error
*
* @return boolean true     Si confirmar contraseña esta correctamente declarada
* @return boolean false    Si confirmar contraseña no esta correctamente declarada
*/
function checkConfirmPassword(){
    let password = $("#password input").val();
    let passwordRep = $("#repeat-password input").val();
    if(passwordRep.length == 0){
        generateMsg("#repeat-password", "Este campo es obligatorio.");
        return false;
    }else if(!checkPasswordMatch(password, passwordRep)){
        generateMsg("#repeat-password", "La contraseña debe coincidir.");
        return false;
    }else {
        removeMsg("#repeat-password");
        return true;
    }
}
/**
* Comprueba si el formato del email es correcto y genera los mensajes de error
*
* @return boolean true     Si el correo esta correctamente declarado
* @return boolean false    Si el correo no esta correctamente declarado
*/
function checkEmail(){
    let email = $("#email input").val();
    if(email.length == 0){
        generateMsg("#email", "Este campo es obligatorio.");
        return false;
    }else if(!checkEmailFormat(email)){
        generateMsg("#email", "El correo electrónico no parece ser valido.");
        return false;
    }else {
        removeMsg("#email");
        return true;
    }
}
/**
* Comprueba si el nombre esta puesto y genera los mensajes de error
*
* @return boolean true     Si el nombre esta correctamente declarado
* @return boolean false    Si el no nombre esta correctamente declarado
*/
function checkName(){
    let name = $("#name input").val();
    if(name.length == 0){
        generateMsg("#name", "Este campo es obligatorio.");
        return false;
    }else {
        removeMsg("#name");
        return true;
    }
}
/**
* Pasa todas las comprobaciones al formulario y envia el formulario si todo esta correcto;
* 
* @return boolean true     Si todos los campos cumplen los requisitos minimos
* @return boolean false    Si algun campo falla
*/
function checkRegisterForm(){
    let usernameCheck = checkUsername();
    let passwordCheck = checkPassword();
    let confirmPasswordCheck = checkConfirmPassword();
    let confirmEmail = checkEmail();
    let confirmName = checkName();
    if(usernameCheck && passwordCheck && confirmPasswordCheck && confirmEmail && confirmName){
        return true;
    }
    return false;
}
$(document).ready(()=>{
    //Borra la contraseña en el campo de confirmar si se cambia la contraseña.
    $("#password input").on("change", ()=>{$("#repeat-password input").val("")})
    //Comporbar nombre usuario
    $("#username").on("change focusout", checkUsername)
    //Comprobar disponibilidad nombre usuario
    $("#username .button").on("click", checkUsernameAvailability)
    //Comprobar contraseña
    $("#password").on("change focusout", checkPassword)
    //Comprobar confirmar contraseña
    $("#repeat-password").on("change focusout", checkConfirmPassword)
    //Comprobar email
    $("#email").on("change focusout", checkEmail)
    //Comprobar disponibilidad email
    $("#email .button").on("click", checkEmailAvailability)
    //Comprobar Nombre
    $("#name").on("change focusout", checkName)
    //Enviar peticion
    $("#register-panel form").on("submit",(e)=>{
        console.log(e)
        e.preventDefault();
        if(checkRegisterForm()){
            e.currentTarget.submit();
        }
    })
})