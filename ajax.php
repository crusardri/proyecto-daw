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
        $uc = $controller->getClothes("",1,-1,-1,1,500);
        $clothes = array();
        if(sizeof($uc)>0){
            //Si encuentra prendas
            foreach($uc as $c){
                array_push($clothes, new Class($c->getID(), $c->getName()){
                    function __construct($id, $name){
                        $this->id = $id;
                        $this->name = $name;
                    }
                });
            }
        }else{
            //Si no encuentra prendas
            array_push($clothes, new Class(-1, "No hay prendas"){
                function __construct($id, $name){
                    $this->id = $id;
                    $this->name = $name;
                }
            });
        }
        echo json_encode($clothes);
    }elseif(isset($_GET["getFixes"])){
        $cf = $controller->getFixes($_GET["getFixes"]);
        $fixes = array();
        if(sizeof($cf) > 0){
            //Si encuentra arreglos
            foreach($cf as $fix){
                array_push($fixes, new Class($fix->getID(), $fix->getName(), $fix->getPrice()){
                    function __construct($id, $name, $price){
                        $this->id = $id;
                        $this->name = $name;
                        $this->price = $price;
                    }
                });
            }
        }else {
            //Si no encuentra arreglos
            array_push($fixes, new Class(-1, "Sin arreglos", 0){
                function __construct($id, $name, $price){
                    $this->id = $id;
                    $this->name = $name;
                    $this->price = $price;
                }
            });
        }
        echo json_encode($fixes);
    }elseif(isset($_GET["getUsers"])){
        //Obtenemos los usuarios buscando por cadena de texto, en cualquier orden, que esten activados, y maximo 10 usuarios
        $us = $userController->getUsers($_GET["getUsers"], -1, 1, -1, -1, 1, 10);
        $users = array();//Inicializamos el array
        if(sizeof($us) > 0){
            //Si encuentra usuarios
            foreach ($us as $u){
                //Añadimos al array un objeto anonimo con las propiedades de la consulta anterior
                array_push($users, new Class($u->getID(), $u->getUsername(), $u->getEmail(), $u->getRole(), $u->getName(), $u->getSurname(), $u->getTelephone()){
                    function __construct($id, $username, $email, $role, $name, $surname, $phone){
                        $this->id = $id;
                        $this->username = $username;
                        $this->email = $email;
                        $this->role = new Class($role->getName(), $role->getCssClass()){
                            function __construct($name, $cssClass){
                                $this->name = $name;
                                $this->cssClass = $cssClass;
                            }
                        };
                        $this->name = $name;
                        $this->surname = $surname;
                        $this->phone = $phone;
                    }
                });
            } 
        }else{
            //Si no encuentra usuarios
            array_push($users, new Class(-1, "Sin usuarios"){
                function __construct($id, $username){
                    $this->id = $id;
                    $this->username = $username;
                }
            });
        }
        echo json_encode($users); //Transformamos e imprimimos el array de objetos de usuario
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


