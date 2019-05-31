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
    //Accion focus
    $(".boxed-input input, label.description-box textarea").on("focus", function(){
        $(this).parents("label.boxed-input, label.description-box").toggleClass("focussed", true);
    })
    //Accion focus out
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
                <select data-class='select-clothe' name='clothe' id='clothe-select-ajax'>\
                    <option value='-1'>Buscando</option>\
                </select>\
            </label>\
            <label class='boxed-select' id='select-fix'>\
                <div>Arreglo</div>\
                <select data-class='select-fix' name='fix' id='fix-select-ajax'>\
                    <option value='-1'>Seleccióne prenda</option>\
                </select>\
            </label>\
            <label class='boxed-input' id='order-item-price' >\
                <div class='text-label'><span>Precio</span></div>\
                <div class='input-container'>\
                    <input type='number' value='0' step='.01'>\
                </div>\
            </label>\
            <label class='description-box order-item-description' id='order-item-description'>\
            <div class='header'>Observaciones</div>\
                <textarea name='order-item-description' id='order-item-description'>Sin descripción</textarea>\
            </label>\
            <div class='form-buttons' id='order-item-submit'>\
                <input type='submit' value='Añadir prenda a la orden' name='createClothe' class='input-submit-button' id='add-order-item'>\
            </div>\
        </div>\
    </div>").appendTo("body");
    $(".new-order-item input, .new-order-item textarea").on("focus", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", true);})
    $(".new-order-item input, .new-order-item textarea").on("focusout", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", false);})
    setTimeout(()=>{
        $("div.modal-box").css("opacity", "1");
    }, 100);
    $("div.modal-box-content").on("click", (e)=>{
        e.stopPropagation();
    })
    $("div.modal-box, div.modal-box-close").on("click", function(e){
        closeModalBox();
    })
    $("div.modal-box div.modal-box-body").on("click", closeSelectDropdown);//Cerrar dropdown
    ajaxGetClothes();
    customSelect("#select-clothe");
    customSelect("#select-fix");
    $("#clothe-select-ajax").on("change", (e)=>{
        let val = $(e.currentTarget).val();
        $("#order-item-price input").val("0");
        console.log(val);
        ajaxGetFixes(val);
    })
    $("#fix-select-ajax").on("change", (e)=>{
        let fixID = $("#fix-select-ajax").val();
        let val = $("#fix-select-ajax option[value="+fixID+"]").attr("price");
        $("#order-item-price input").val(val);
    })
    $("#add-order-item").on("click", addOrderItem)//Añadir nuevo order item


    
}

function ajaxGetClothes(){
    $("#add-order-item").off("click", addOrderItem)
    $.ajax({
        url: "ajax.php",
        method: "GET",
        data: {getClothes: ""},
        dataType: "html"
    }).done((res)=>{
        console.log("%cEsta es la respuesta del servidor de getClothe.", 'background: rgba(255,0,0,0.5); color: #000');
        console.log(res)
        let json = JSON.parse(res);
        console.log("%cEsta es la respuesta parseada como JSON", 'background: rgba(255,0,0,0.5); color: #000');
        console.log(json);
        console.log("%cFin de la respuesta del servidor de Get Clothe", 'background: rgba(255,0,0,0.5); color: #000');
        //Borrar options select clothe
        $("#clothe-select-ajax").children().remove();
        //Añadir opcion placeholder
        $("<option>", {
            value: -1,
            html: "Selecciona prenda"
        }).appendTo("#clothe-select-ajax");
        //Recorrer array
        $.each(json, function(){
            $("<option>", {
                value: this.id,
                html: this.name
            }).appendTo("#clothe-select-ajax");
        })
        //Borrar menu select personalizado
        $("#select-clothe > .custom-select").remove();
        //Crear menu select personalizado
        customSelect("#select-clothe");
        $("#add-order-item").on("click", addOrderItem)
    })
}
function ajaxGetFixes(clotheID){
    $("#add-order-item").off("click", addOrderItem)
    $.ajax({
        url: "ajax.php",
        method: "GET",
        data: {getFixes: clotheID},
        dataType: "html"
    }).done((res)=>{
        console.log("%cEsta es la respuesta del servidor de getFixes.", 'background: rgba(0,255,0,0.5); color: #000');
        console.log(res)
        let json = JSON.parse(res);
        console.log("%cEsta es la respuesta parseada como JSON", 'background: rgba(0,255,0,0.5); color: #000');
        console.log(json);
        console.log("%cFin de la respuesta del servidor de Get Fixes", 'background: rgba(0,255,0,0.5); color: #000')
        //Borrar options select fix
        $("#fix-select-ajax").children().remove();
        //Añadir opcion placeholder
        $("<option>", {
            value: -1,
            html: "Seleccione arreglo"
        }).appendTo("#fix-select-ajax");
        $.each(json, function(){
            $("<option>", {
                value: this.id,
                html: this.name,
                price: this.price
            }).appendTo("#fix-select-ajax");
        })
        //Borrar menu select personalizado
        $("#select-fix > .custom-select").remove();
        //Crear menu select personalizado
        customSelect("#select-fix");
        $("#add-order-item").on("click", addOrderItem)
    })
}

function addOrderItem(){
    let clotheID = $("#clothe-select-ajax").val(); //ID de la prenda
    let fixID = $("#fix-select-ajax").val(); //ID del arreglo
    let description = $("#order-item-description textarea").val(); //Contenido de la descripción
    let price = $("#order-item-price input").val(); //Precio del option del select de fix
    let fixName = $("#fix-select-ajax option[value="+fixID+"]").text(); //Nombre del option del select de Fix
    let clotheName = $("#clothe-select-ajax option[value="+clotheID+"]").text(); //Nombre del option del select de clothe
    console.log(clotheID);
    console.log(fixID);
    console.log(description);
    console.log(price);
    console.log(clotheName);
    console.log(fixName);
    if(clotheID > -1 && fixID > -1){
        //Borrar el placeholder de order-items
        $(".no-order-items").remove(); 
        //Creamos el nuevo order item
        let orderItem = $('<div class="order-item">\
            <input type="hidden" value="'+clotheID+'" name="orderItemClotheID[]">\
            <input type="hidden" value="'+fixID+'" name="orderItemFixID[]">\
            <label class="boxed-input clothe">\
                <div class="text-label"><span>Prenda</span></div>\
                <div class="input-container">\
                    <input type="text" value="'+clotheName+'" disabled="">\
                </div>\
            </label>\
            <label class="boxed-input fix">\
                <div class="text-label"><span>Arreglo</span></div>\
                <div class="input-container">\
                    <input type="text" value="'+fixName+'" disabled="">\
                </div>\
            </label>\
            <label class="boxed-input price">\
                <div class="text-label"><span>Precio</span></div>\
                <div class="input-container">\
                    <input type="number" value="'+price+'" name="orderItemPrice[]" step=".01">\
                </div>\
            </label>\
            <label class="description-box order-item-description">\
            <div class="header">Observaciones</div>\
                <textarea name="orderItemDescription[]">'+description+'</textarea>\
            </label>\
            <div class="button remove-order-item">Borrar</div>\
        </div>')
        
        //Asignamos las animaciones de focus al los text-area y los inputs
        orderItem.find("input, textarea").on("focus", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", true);})
        orderItem.find("input, textarea").on("focusout", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", false);})
        //Asignamos el evento de borrar order-item al boton
        orderItem.find(".remove-order-item").on("click", removeOrderItem);
        //Añadimos el order items al contenedor principal
        orderItem.appendTo(".order-items");
        //Simulamos pulsar boton cerrar ventana
        $("div.modal-box, div.modal-box-close").click();
    }else{
        //Si no hay ninguna prenda y arreglo seleciconado, mensaje de error
        $("<div class='msg error'>Debes seleccionar una prenda y un arreglo.</div>").appendTo(".modal-box.new-order-item .modal-box-body");
    }
}
function removeOrderItem(e){
    $(this).parent().remove(); //Borramos el contenedor del order item
    if($(".order-items > .order-item").length <= 0){ //Si no hay mas order-items, se pone el placeholder
        $('<div class="no-order-items">No hay prendas registradas.</div>').appendTo(".order-items");
    }
}