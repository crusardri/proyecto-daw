var users = {};

$(window).ready(()=>{
    $("#search-client").on("click", ()=>{
        modalBoxSearchUser();
    })
    $("#search-employee").on("click", ()=>{
        modalBoxSearchUser(1);
    })
})
function modalBoxSearchUser(userType){
    let modalTitle = "Buscar Cliente";
    if(userType == 1){
        modalTitle = "Buscar Empleado";
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
                </form>\
                <div class='search-user-results'>\
                </div>\
            </div>\
        </div>\
    </div>").appendTo("body");
    
    $("div.modal-box-content").on("click", (e)=>{
        e.stopPropagation();
    })
    $("div.modal-box, div.modal-box-close").on("click", (e)=>{
        $("div.modal-box").remove();
    })
    
}