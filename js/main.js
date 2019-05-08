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
        let $tag = $("<div class='user-search-result'><span class='user'>" +user.username + "#" + user.id + "</span> <span class='name'>" + user.name + " " + user.surname + "</span><span class='role label-box "+user.roleClass+"'>"+user.role+"</span></div>");
        $tag.data("user", user);
        $tag.on("click", function(e){
            changeUserInfo($(this).data("user"));
            closeModalBox();
        })
        $tag.appendTo("div.user-search-results");
        //console.log($tag.data("user"))
        //console.log(user);
    });
}
$(window).ready(()=>{
    $("#search-client").on("click", ()=>{
        modalBoxSearchUser();
        showUsers(users);
    })
    $("#search-employee").on("click", ()=>{
        modalBoxSearchUser(1);
        showUsers(users, 1);
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
function modalBoxSearchUser(userType){
    if(userType == 1){
        modalTitle = "Buscar Empleado";
    } else {
        modalTitle = "Buscar Cliente";
    }
    $("<div class='modal-box search-user'>\
        <div class='modal-box-content'>\
            <h1 class='modal-box-title'>"+modalTitle+"</h1>\
            <div class='modal-box-close'>x</div>\
            <div class='modal-box-body'>\
                <form>\
                    <div class='search-box'>\
                        <input type='text' placeholder='Buscar usuario por nombre, apellidos o ID'>\
                        <input type='submit' value'Buscar'>\
                    </div>\
                    <div class='user-search-results'></div>\
                </form>\
            </div>\
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