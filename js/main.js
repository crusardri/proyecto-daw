var users = {
    000001: {
        id: "0001",
        name: "Iván",
        surname: "Maldonado Fernandez",
        username: "Ivan",
        email: "ivan@dondedal.es",
        phone: "918283748",
        role: "Administrador",
        roleClass: "admin"
    },
    000002: {
        id: "0002",
        name: "Halfonso",
        surname: "Fernandez Zapatero",
        username: "Halfonso",
        email: "gmail@halfonso.com",
        phone: "918253248",
        role: "Cliente",
        roleClass: "client"
    },
    000003: {
        id: "0003",
        name: "Halfredo",
        surname: "Pelayo Pelayette",
        username: "Halfredo",
        email: "hotmail@halfredo.es",
        phone: "689663322",
        role: "Empleado",
        roleClass: "employee"
    },
};
var clothes = {
    1: {
        id: 1,
        name: "vaqueros",
        fixes: 3
    },
    2: {
        id: 2,
        name: "blusa",
        fixes: 3
    },
    3: {
        id: 3,
        name: "abrigo",
        fixes: 3
    },
}
var fixes = {
    1: {
        id: 1,
        name: "bajo",
        price: 10
    },
    2: {
        id: 2,
        name: "ensanchado",
        price: 20
    },
    3: {
        id: 3,
        name: "arreglo",
        price: 5
    }
}

/*
* Modifica los valores de los inputs del fieldset de Cliente
*/
function changeClientInfo(user){
    $("#client-id").val(user.id);
    $("#client-username").val(user.username + "#" + user.id);
    $("#client-name").val(user.name);
    $("#client-surname").val(user.surname);
    $("#client-email").val(user.email);
    $("#client-phone").val(user.phone);
}
/*
* Modifica los valores de los inputs del fieldset de empleado
*/
function changeEmployeeInfo(user){
    $("#employee-id").val(user.id);
    $("#employee-username").val(user.username + "#" +user.id);
    $("#employee-name").val(user.name);
    $("#employee-surname").val(user.surname);
}
/*
* Muestra los usuarios en la ventana modal de busqueda de usuarios
*/
function showUsers(users, type){
    console.log(users);
    let changeUserInfo;
    if(type == 1){
        changeUserInfo = changeEmployeeInfo;
        console.log("changeEmployeeInfo")
    } else {
        changeUserInfo = changeClientInfo;
        console.log("changeClientInfo")
    }
    Object.keys(users).forEach((k)=>{
        let user = users[k];
        let $tag = $("<div class='user modal-search-result'><span class='user'>" +user.username + "#" + user.id + "</span> <span class='name'>" + user.name + " " + user.surname + "</span><span class='role label-box "+user.roleClass+"'>"+user.role+"</span></div>");
        $tag.data("user", user);
        $tag.on("click", function(e){
            changeUserInfo($(this).data("user"));
            closeModalBox();
        })
        $tag.appendTo("div.modal-search-results.users");
        //console.log($tag.data("user"))
        //console.log(user);
    });
}

/*
* Muestra las prendas en la ventana modal de busqueda de prendas
*/
function showClothes(){
    console.log(clothes);
    Object.keys(clothes).forEach((k)=>{
        let clothe = clothes[k];
        let $tag = $("<div class='clothes modal-search-result'><span class='clothe-name'>" +clothe.name + "</span><span class='clothe-num-fixes'> Arreglos: " + clothe.fixes + "</span></div>");
        $tag.data("clothe", clothe);
        $tag.on("click", function(e){
            showFixes();
            closeModalBox();
        })
        $tag.appendTo("div.modal-search-results.clothes");
        //console.log($tag.data("user"))
        //console.log(user);
    });
}

$(document).ready(()=>{
    /*Animacion focus boxed-input*/
    $(".boxed-input input, label.description-box textarea").on("focus", function(){
        $(this).parents("label.boxed-input, label.description-box").toggleClass("focussed", true);
    })
    $(".boxed-input input, label.description-box textarea").on("focusout", function(){
        $(this).parents("label.boxed-input, label.description-box").toggleClass("focussed", false);
    })
    //Abrir ventana modal busqueda cliente
    $("#search-client").on("click", ()=>{
        modalBox("Buscar Cliente", showSearchUserForm);
        showUsers(users);
    })
    //Abrir ventana modal busqueda trabajador
    $("#search-employee").on("click", ()=>{
        modalBox("Buscar Trabajador", showSearchUserForm);
        showUsers(users, 1);
    })
    //Abrir ventana modal busqueda prenda
    $("#new-order-item").on("click", ()=>{
        modalBox("Añadir Prenda", showClothesSearchForm);
        showClothes();
    })
})
/*
* Cierra la ventana modal con un fadeout
*/
function closeModalBox(){
    $("div.modal-box").css("opacity", "0");
    setTimeout(()=>{
        $("div.modal-box").remove();
    }, 200)
    
}
/*
* Abre la ventan modal de busqueda de usuario por Ajax con un FadeIn
*/
function modalBox(title, callback){
    $("<div class='modal-box search-user'>\
        <div class='modal-box-content'>\
            <h1 class='modal-box-title'>"+title+"</h1>\
            <div class='modal-box-close'>x</div>\
            <div class='modal-box-body'>"+
            callback()+
            "</div>\
        </div>\
    </div>").appendTo("body");
    setTimeout(()=>{
        $("div.modal-box").css("opacity", "1")
    }, 100)
    
    $("div.modal-box-content").on("click", (e)=>{
        e.stopPropagation();
    })
    $("div.modal-box, div.modal-box-close").on("click", function(e){
        closeModalBox();
    })
    
}

function showSearchUserForm(){
    return "<form>\
        <div class='search-box'>\
            <input type='text' placeholder='Buscar usuario por nombre, apellidos o ID'>\
            <input type='submit' value'Buscar'>\
        </div>\
        <div class='modal-search-results users'></div>\
    </form>"
}

function showClothesSearchForm(){
    return "<form>\
        <div class='search-box'>\
            <input type='text' placeholder='Buscar prenda por ID o Nombre'>\
            <input type='submit' value'Buscar'>\
        </div>\
        <div class='modal-search-results clothes'></div>\
    </form>"
}
