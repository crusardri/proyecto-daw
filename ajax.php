<?php
/**
 * 
 * CONTROLADOR AJAX
 * 
 * 
 */
session_start();
require_once("Controllers/UserController.php");
require_once("Controllers/Controller.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");
require_once("Classes/Clothe.php");
require_once("Classes/Fix.php");
require_once("Classes/Order.php");
require_once("Classes/Estate.php");
require_once("Classes/OrderItem.php");
require_once("ViewControllers/vistaController.php");

if(isset($_SESSION["userID"])){
    $userController = new UserController();
    $controller = new Controller();
    $user = $userController->getUser($_SESSION["userID"]);
    $userRole = $user->getRole();
    if($userRole->getID() == 0){
        die("No estas autorizado para hacer eso.");
    }
    if(isset($_GET["getClothes"])){
        $controller->getClothes("",1,-1,-1,1,500);
        ?>
{
    "1": {
        "id": "1",
        "name": "vaqueros"
    },
    
    "2": {
        "id": "2",
        "name": "blusa"
    },
    "3": {
        "id": "3",
        "name": "abrigo"
    }
}
        <?php
    }elseif(isset($_GET["getFixes"])){
        //$controller->getFixes($_GET["getFixes"]);
?>
{
    "1": {
        "id": "1",
        "name": "bajo",
        "price": "10"
    },
    "2": {
        "id": "2",
        "name": "ensanchado",
        "price": "20"
    },
    "3": {
        "id": "3",
        "name": "arreglo",
        "price": "5"
    }
}
<?php
    }elseif(isset($_GET["getUsers"])){
        $userController->getUsers($_GET["getUsers"], -1, 1, -1, -1, 1, 10);
?>
{
    1: {
        "id": 0,
        "username": "Halfonso",
        "email": "Halfo@sett.es",
        "role": {
            "name": "Cliente",
            "cssClass": "client"
        }
        "name": "Halfonso",
        "surname": "Halfonsette",
        "phone": "9191919191"
    },
    2: {
        "id": 1,
        "username": "Halfredo",
        "email": "Hal@fre.do",
        "role": {
            "name": "Empleado",
            "cssClass": "employee"
        }
        "name": "Halfredo",
        "surname": "Haldredette",
        "phone": "8484848393"
    },
    3: {
        "id": 3,
        "username": "Mafalda",
        "email": "Maf@al.da",
        "role": {
            "name": "Administrador",
            "cssClass": "admin"
        }
        "name": "Mafalda",
        "surname": "Zapatero",
        "phone": "828573829384"
    }
}
<?php
    }
}elseif(isset($_GET["check_username"])){
    $uc = new UserController();
    if($uc->checkUsername($_GET["check_username"])){
        echo "DISPONIBLE";
    }else {
        echo "NO DISPONIBLE";
    }
}elseif(isset($_GET["check_email"])){
    $uc = new UserController();
    if($uc->checkEmail($_GET["check_email"])){
        echo "DISPONIBLE";
    }else {
        echo "NO DISPONIBLE";
    }
}else{
    echo "Nope";
}


