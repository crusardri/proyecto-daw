/* Custom Select */
function closeSelectDropdown(){
    $(".custom-select-dropdown").addClass("hidden");
    $(".custom-select-dropdown").parent().removeClass("selected");
}
function customSelect(selector, callback){
    let select = $(selector + " > select")
    let options = $(selector + " > select > option");
    let selectDropdown = $("<div>", {"class": "custom-select-dropdown hidden"})
    let selectedOptionText = $(selector + " > select > option:selected").text();
    let selectClass = $(selector + " > select").attr("data-class");
    //Crea el contenedor del selector custom
    $("<div>", {
        "class": "custom-select " + selectClass,
    }).appendTo(selector);
    //Crear contenedor texto selector custom
    $("<span>", {
        "class": "custom-select-text", 
        text: selectedOptionText
    }).appendTo(selector + " .custom-select")
    //Incluye el contenedor de opciones al selector custom
    selectDropdown.appendTo(selector + " > .custom-select")
    for(let option of options){
        //Crea un elemento del menu
        let optionValue = $(option).val();
        let customSelectItem = $("<div>", {
            "class": "custom-select-option"
        })
        .data("value", optionValue)
        .append(callback(option))
        //Asigna un evento al hacer click que modifica el contenedor select
        customSelectItem.on("click", function(e){
            e.stopPropagation();
            let value = $(this).data("value")
            select.val(value);
            $(selector + " span.custom-select-text").text($(selector + " option:selected").text());
            closeSelectDropdown();
        })
        //Asigna el elemento del menu al contenedor de elementos
        customSelectItem.appendTo(selectDropdown)
    }
    
    /* Evento desplegar menú al hacer click */
    $(selector + " > div.custom-select").on("click", (e)=>{
        e.stopPropagation();
        closeSelectDropdown();
        selectDropdown.removeClass("hidden");
        selectDropdown.parent().addClass("selected");
    })
    /* Parar propagacion ocultar los contenedores de opciones de los custom-selects */
    $(selector).on("click", (e)=>{
        e.stopPropagation();
    })
}
$(document).ready(()=>{
    /* Ocultar todos los contenedores de opciones de los custom-selects */
    $(document).on("click", ()=>{
        closeSelectDropdown();
    })
    customSelect("#order-estate-filter", (elem)=>{
        let elemClass = $(elem).attr("data-class");
        let elemStyle = $(elem).attr("data-style");
        let elemText = $(elem).text();    
        return $("<span>", {
            "class": "label-box " + elemClass || null,
            text: elemText,
            "style": elemStyle
        })
    });
    customSelect("#order-by-filter", (elem)=>{
        return $(elem).text();    
    });
});