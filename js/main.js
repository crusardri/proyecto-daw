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
    $("body > *").css("opacity", "1");
    /*Animacion focus boxed-input*/
    $(".boxed-input input, label.description-box textarea").on("focus", function(){
        $(this).parents("label.boxed-input, label.description-box").toggleClass("focussed", true);
    })
    $(".boxed-input input, label.description-box textarea").on("focusout", function(){
        $(this).parents("label.boxed-input, label.description-box").toggleClass("focussed", false);
    })
    $(".boxed-input input:focus, label.description-box textarea:focus")
    .parents("label.boxed-input, label.description-box")
    .toggleClass("focussed", true);
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
        showAddOrderItemForm();
    })
    //Abrir ventana modal crear arreglo
    $("#add-fix").on("click", ()=>{
        let clotheID = parseInt($("#clotheID").children("div.input-container").children("input").val());
        let clotheName = $("#clothe-name").children("div.input-container").children("input").val()
        showAddFixForm(clotheID, clotheName)
    })
    //Abrir ventana modal crear prenda
     $("#add-clothe").on("click", showNewClotheForm);
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


function showAddFixForm(clotheID, clotheName){
    $("<div class='modal-box add-fix'>\
    <div class='modal-box-content'>\
        <h1 class='modal-box-title'>Añadir nuevo arreglo a "+clotheName+"</h1>\
        <div class='modal-box-close'>x</div>\
        <div class='modal-box-body'>\
            <form method='post' action='clothe.php?id="+clotheID+"'>\
            <input type='hidden' name='addFix'>\
            <input type='hidden' value='"+clotheID+"' name='clotheID'>\
            <label class='boxed-input' >\
                <div class='text-label'><span>Nombre</span></div>\
                <div class='input-container'>\
                    <input type='text' name='fixName' value=''>\
                </div>\
            </label>\
            <label class='boxed-input' >\
                <div class='text-label'><span>Precio</span></div>\
                <div class='input-container'>\
                    <input type='number' name='fixPrice' value=''>\
                </div>\
            </label>\
            <div>\
                <label class='boxed-radio active'>\
                    <input type='radio' name='active' value='1' checked>\
                    <div class='container'>\
                        <div class='radio-checkbox'>&#x2713;</div>\
                        <div class='radio-title'>Activado</div>\
                        <div class='radio-desc'>Aparecerá en los listados y estará disponible para añadir en nuevas órdenes.</div>\
                    </div>\
                </label>\
                <label class='boxed-radio disabled'>\
                    <input type='radio' name='active' value='0'>\
                    <div class='container'>\
                        <div class='radio-checkbox'>&#x2713;</div>\
                        <div class='radio-title'>Desactivado</div>\
                        <div class='radio-desc'>No se podrá añadir a nuevas órdenes, pero se mantendrán en órdenes antiguas para consulta.</div>\
                    </div>\
                </label>\
            </div>\
            <div class='form-buttons'>\
                <input type='submit' value='Registrar prenda' name='registerFix' class='input-submit-button'>\
            </div>\
            </form>\
        </div>\
    </div>").appendTo("body");
    setTimeout(()=>{
        $("div.modal-box").css("opacity", "1");
    }, 100);
    $("div.modal-box-content").on("click", (e)=>{
        e.stopPropagation();
    })
    $("div.modal-box, div.modal-box-close").on("click", function(e){
        closeModalBox();
    })
}

function showNewClotheForm(){
    $("<div class='modal-box new-clothe'>\
    <div class='modal-box-content'>\
        <h1 class='modal-box-title'>Registrar nueva prenda</h1>\
        <div class='modal-box-close'>x</div>\
        <div class='modal-box-body'>\
            <form method='post' action='clothes.php'>\
            <label class='boxed-input' >\
                <div class='text-label'><span>Nombre</span></div>\
                <div class='input-container'>\
                    <input type='text' name='clotheName' value=''>\
                </div>\
            </label>\
            <div class='form-buttons'>\
                <input type='submit' value='Registrar prenda' name='createClothe' class='input-submit-button'>\
            </div>\
            </form>\
        </div>\
    </div>").appendTo("body");
    setTimeout(()=>{
        $("div.modal-box").css("opacity", "1");
    }, 100);
    $("div.modal-box-content").on("click", (e)=>{
        e.stopPropagation();
    })
    $("div.modal-box, div.modal-box-close").on("click", function(e){
        closeModalBox();
    })
}

function showAddOrderItemForm(){
    $("<div class='modal-box new-order-item'>\
    <div class='modal-box-content'>\
        <h1 class='modal-box-title'>Añadir nueva prenda</h1>\
        <div class='modal-box-close'>x</div>\
        <div class='modal-box-body'>\
            <label class='boxed-select' id='select-clothe'>\
                <div>Prenda</div>\
                <select data-class='select-clothe' name='clothe'>\
                    <option value='0'>Vaqueros</option>\
                    <option value='1'>Blusa</option>\
                    <option value='2'>Opel Corsa</option>\
                </select>\
            </label>\
            <label class='boxed-select' id='select-fix'>\
                <div>Arreglo</div>\
                <select data-class='select-fix' name='fix'>\
                    <option value='0'>Bajo</option>\
                    <option value='1'>Alto</option>\
                    <option value='2'>Cambio de aceite</option>\
                </select>\
            </label>\
            <label class='description-box order-item-description' id='order-item-description'>\
            <div class='header'>Observaciones</div>\
                <textarea name='order-item-description'>Sin descripción</textarea>\
            </label>\
            <div class='form-buttons' id='order-item-submit'>\
                <input type='submit' value='Añadir prenda a la orden' name='createClothe' class='input-submit-button'>\
            </div>\
        </div>\
    </div>").appendTo("body");
    setTimeout(()=>{
        $("div.modal-box").css("opacity", "1");
    }, 100);
    $("div.modal-box-content").on("click", (e)=>{
        e.stopPropagation();
    })
    $("div.modal-box, div.modal-box-close").on("click", function(e){
        closeModalBox();
    })
    customSelect("#select-clothe");
    customSelect("#select-fix");
}

