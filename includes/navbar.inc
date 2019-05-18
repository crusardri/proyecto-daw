    <nav class="top-header">
        <a class="menu-item" href="#">
            <img src="media/img/inicio.png">
            <div class="label">Inicio</div>
        </a>
        <a class="menu-item" href="#">
            <img src="media/img/order.png">
            <div class="label">Órdenes</div>
        </a>
        <a class="menu-item" href="#">
            <img src="media/img/prendas.png">
            <div class="label">Prendas</div>
        </a>
        <a class="menu-item" href="#">
            <img src="media/img/users.png">
            <div class="label">Usuarios</div>
        </a>
        <a class="menu-item user" href="#">
            <div class="user-avatar">IM</div>
            <div class="username"><?=$user->getName()." ".$user->getSurname()?></div>
        </a>
    </nav>