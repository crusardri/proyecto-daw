/*
* Cierra la ventana modal con un fadeout
*/
function closeModalBox(){
    $("div.modal-box").css("opacity", "0");
    setTimeout(()=>{
        $("div.modal-box").remove();
    }, 200)
    
}


var searchUsersTimeout; //setTimeout de users
/**
 * Muestra la ventana de busqueda de usuario.
 * 
 * @param {String} title                    Titulo de la ventana
 * @param {boolean} userType                Tipo de usuario, True empleado, false cliente
 */
function showSearchUserBox(title, userType){
    let modalBox = $("<div class='modal-box search-user'>\
        <div class='modal-box-content'>\
            <h1 class='modal-box-title'>"+title+"</h1>\
            <div class='modal-box-close'>x</div>\
            <div class='modal-box-body'>\
            <label class='boxed-input' id='searchbox'>\
                <div class='text-label'><span>Buscar</span></div>\
                <div class='input-container'>\
                    <input type='text' autofocus placeholder='Buscar prenda por ID o nombre ' name='search' value=''>\
                </div>\
            </label>\
            <div id='modal-search-results'></div>\
            </div>\
        </div>\
    </div>")
    modalBox.find("input, textarea").on("focus", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", true);})
    modalBox.find("input, textarea").on("focusout", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", false);})
    modalBox.appendTo("body");
    //Animacion entrada
    setTimeout(()=>{
        $("div.modal-box").css("opacity", "1")
    }, 100)
    //Prevenir propagacion cerrar
    $("div.modal-box-content").on("click", (e)=>{
        e.stopPropagation();
    })
    //Asignar evento cerrar
    $("div.modal-box, div.modal-box-close").on("click", function(e){
        closeModalBox();
    })
    //Buscamos usuarios
    ajaxGetUsers("", userType);
    //Asignamos evento al teclear en el campo de busqueda
    modalBox.find("input").on("keyup",(e)=>{
        let search = $(e.currentTarget);
        window.clearTimeout(searchUsersTimeout);
        searchUsersTimeout = setTimeout(()=>ajaxGetUsers(search.val(), userType),250);
    }) 
}
/**
 * Obtenemos los usuarios mediante un ajax al servidor y generamos los resultados de busqueda
 * 
 * @param {String} searchString 
 */
function ajaxGetUsers(searchString, type){
    let noClients = "0";
    if(type){
        noClients = "1";
    }
    $.ajax({
        url: "ajax.php",
        method: "GET",
        data: {
            getUsers: searchString,
            noClients: noClients
        },
        dataType: "html"
    }).done((res)=>{
        console.log("%cEsta es la respuesta del servidor de getUsers.", 'background: rgba(0,0,255,0.5); color: #000');
        console.log(res)
        let json = JSON.parse(res);
        console.log("%cEsta es la respuesta parseada como JSON", 'background: rgba(0,0,255,0.5); color: #000');
        console.log(json);
        console.log("%cFin de la respuesta del servidor de Get Users", 'background: rgba(0,0,255,0.5); color: #000');
        $("#modal-search-results > div.user-result").remove();
        $.each(json, function(){
            if(this.id > 0){
                let item = $("<div>",{
                    class: "user-result"
                })
                //ID de usuario
                $("<div>",{
                    class: "user-id",
                    text: this.id.padStart(4, 0)
                }).appendTo(item);
                //Nombre de usuario
                $("<div>",{
                    class: "username",
                    text: this.username
                }).appendTo(item);
                //Rol de usuario
                $("<span>",{
                    class: "role label-box " + this.role.cssClass,
                    text: this.role.name
                }).appendTo(item);
                //Nombre
                $("<div>",{
                    class: "name",
                    text: this.name
                }).appendTo(item);
                //Apellidos
                $("<div>",{
                    class: "surname",
                    text: this.surname
                }).appendTo(item);
                //Telefono
                $("<div>",{
                    class: "phone",
                    text: this.phone
                }).appendTo(item);
                //Correo
                $("<div>",{
                    class: "email",
                    text: this.email
                }).appendTo(item);
                item.data("username", this.username);
                item.data("name", this.name);
                item.data("surname", this.surname);
                item.data("email", this.email);
                item.data("phone", this.phone);
                item.data("id", this.id);
                item.appendTo("#modal-search-results");
                //Evento añadir usuario a la órden;
                item.on("click",function(e){
                    console.log(type)
                    changeUserInfo(type, item.data());
                    closeModalBox();
                })
            }else {
                let item = $("<div>",{
                    class: "user-result no-items",
                    html: "<div>No se han encontrado usuarios</div>"
                })
                item.data("id", this.id);
                item.appendTo("#modal-search-results");
            }
            
        });
    });
}
/**
 * Modifica la información de usuario
 * @param {*} clotheID 
 * @param {*} clotheName 
 */
function changeUserInfo(type, data){
    let inputName;
    let selector;
    if(type){
        selector = "#employee-infoset";
        inputName = "employeeID";
    }else{
        selector = "#client-infoset";
        inputName = "clientID";
    }
    console.log(selector);
    let item = $(selector + ' .user-data');
    item.children().remove();
    //Campo escondido clientID
    item.append('<input type="hidden" value="'+data.id+'" name="'+inputName+'">');
    //Campo Usuario
    item.append('<div class="info-set">\
                    <div class="form-info-title">Usuario</div>\
                    <div class="form-info-data"><input type="text" value="'+data.username+'"disabled></div>\
                 </div>');
    //Campo Nombre
    item.append('<div class="info-set">\
                    <div class="form-info-title">Nombre</div>\
                    <div class="form-info-data"><input type="text" value="'+data.name+'"disabled></div>\
                </div>');
    //Campo Apellidos
    item.append('<div class="info-set">\
                    <div class="form-info-title">Apellidos</div>\
                    <div class="form-info-data"><input type="text" value="'+data.surname+'"disabled></div>\
                </div>');
    //Si es un cliente muestra el campo correo y telefono
    if(!type){
        //Campo Correo
        item.append('<div class="info-set">\
                    <div class="form-info-title">Correo electrónico</div>\
                    <div class="form-info-data"><input type="text" value="'+data.email+'"disabled></div>\
                </div>');
        //Campo Teléfono        
        item.append('<div class="info-set">\
                    <div class="form-info-title">Teléfono</div>\
                    <div class="form-info-data"><input type="text" value="'+data.phone+'"disabled></div>\
                </div>');
    }
    
    
    //Campo para cuadrar el flex
    item.append('<div class="info-set hidden"></div>');
}
/**
 * Genera una ventana modal con un formulario para crear un nuevo arreglo a una prenda
 * 
 * @param {int} clotheID                    ID de la prenda a añadir el arreglo
 * @param {String} clotheName               Nombre de la prenda
 */
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
                    <input type='number' name='fixPrice' value='' step='.01'>\
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
/**
 * Genera una ventana modal para registrar una nueva prenda
 */
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
/**
 * Genera una ventana modal para añadir un order item
 */
function showAddOrderItemForm(){
    let = form = $("<div class='modal-box new-order-item'>\
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
    </div>")
    form.find("input, textarea").on("focus", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", true);})
    form.find("input, textarea").on("focusout", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", false);})
    form.appendTo("body");
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

/**
 * Obtiene una lista de prendas mediante un ajax hacia el servidor
 * Por cada prenda genera un option dentro de un select
 * Al hacer click en una prenda, dispara el ajax de obtener arreglos 
 */
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
        $("#add-order-item").on("click", addOrderItem);
        
    })
}

/**
 * Obtiene una lista de arreglos de una prenda mendiante un ajax hacia el servidor
 * Por cada arreglo encontrado genera un nuevo options al select de arreglos.
 * 
 * @param {int} clotheID                        ID de la prenda a buscar
 */
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
/**
 * Añade un order item al contenedor de order-items
 */
function addOrderItem(){
    let clotheID = $("#clothe-select-ajax").val(); //ID de la prenda
    let fixID = $("#fix-select-ajax").val(); //ID del arreglo
    let description = $("#order-item-description textarea").val(); //Contenido de la descripción
    let price = $("#order-item-price input").val(); //Precio del option del select de fix
    let fixName = $("#fix-select-ajax option[value="+fixID+"]").text(); //Nombre del option del select de Fix
    let clotheName = $("#clothe-select-ajax option[value="+clotheID+"]").text(); //Nombre del option del select de clothe
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
        //Asignamos evento calcular precio al cambiar el formulario de precio
        orderItem.find(".price input").on("keyup change", calculatePrice);
        //Asignamos las animaciones de focus al los text-area y los inputs
        orderItem.find("input, textarea").on("focus", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", true);})
        orderItem.find("input, textarea").on("focusout", (e)=>{$(e.currentTarget).parents("label.boxed-input, label.description-box").toggleClass("focussed", false);})
        //Asignamos el evento de borrar order-item al boton
        orderItem.find(".remove-order-item").on("click", removeOrderItem);
        //Añadimos el order items al contenedor principal
        orderItem.appendTo(".order-items");
        //Cerramos ventana
        closeModalBox();
        //Recalculamos el precio total de la orden
        calculatePrice();
    }else{
        //Si no hay ninguna prenda y arreglo seleciconado, mensaje de error
        $("<div class='msg error'>Debes seleccionar una prenda y un arreglo.</div>").appendTo(".modal-box.new-order-item .modal-box-body");
    }
}
/**
 * Calcula el precio total de la orden
 */
function calculatePrice(){
    items = $(".boxed-input.price input");
    let totalPrice = 0;
    $.each(items, function(){
        totalPrice += parseFloat($(this).val());
    })
    
    $("#total-price-container input").val(totalPrice.toFixed(2)+"€");

}
/**
 * Elimina un contenedor de order item del contenedor order-items
 */
function removeOrderItem(){
    $(this).parent().remove(); //Borramos el contenedor del order item
    if($(".order-items > .order-item").length <= 0){ //Si no hay mas order-items, se pone el placeholder
        $('<div class="no-order-items">No hay prendas registradas.</div>').appendTo(".order-items");
    }
    calculatePrice();
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
        showSearchUserBox("Buscar Cliente", false);
    })
    //Abrir ventana modal busqueda trabajador
    $("#search-employee").on("click", ()=>{
        showSearchUserBox("Buscar Trabajador", true);
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
     //Asignar evento a los botones de borrar order-item al cargar la pagina
     $(".button.remove-order-item").on("click", removeOrderItem);

     //Al cambiar algun input de precio
     $(".boxed-input.price input").on("keyup change", calculatePrice);
     //Al cargar la pagina, calculamos el preico total
     calculatePrice();
})