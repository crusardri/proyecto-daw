<?php
//Cerramos sesion
if(isset($_GET["logout"])){
    $userController->logout();
    header("location: login.php");
}
?>
    <nav class="top-header">
        <a class="menu-item" href="index.php">
            <img src="media/img/inicio.png">
            <div class="label">Inicio</div>
        </a>
        <a class="menu-item" href="orders.php">
            <img src="media/img/order.png">
            <div class="label">Órdenes</div>
        </a>
        <?php 
        if($employee||$admin){
            ?>
        <a class="menu-item" href="clothes.php">
            <img src="media/img/prendas.png">
            <div class="label">Prendas</div>
        </a>
        <a class="menu-item" href="users.php">
            <img src="media/img/users.png">
            <div class="label">Usuarios</div>
        </a>
            <?php
        }
        ?>
        <a class="menu-item user" href="user.php?id=<?=$sessionUser->getID()?>">
            <div class="user-avatar"><?=substr($sessionUser->getName(), 0,1) . substr($sessionUser->getSurname(), 0,1)?></div>
            <div class="username"><?=$sessionUser->getName()." ".$sessionUser->getSurname()?></div>
        </a>
    </nav>