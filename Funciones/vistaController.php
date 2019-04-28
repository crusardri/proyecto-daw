<?php
function showOrdersShowcase($titulo){
    ?>
    <div class="showcase order-showcase">
        <div class="title"><?=$titulo?><a class="button" href="">Ver todas</a></div>
        <div class="order-container">
            <a href="" class="order-item pending">
                <div class="estate pending"></div>
                <div class="order-info">
                    <div class="item-id a-center">
                        <span class="label">ID: </span>
                        <span class="content">000001</span>
                    </div>
                    <div class="item-id">
                        <span class="label">Estado: </span>
                        <span class="content label-box pending">Pendiente</span>
                    </div>
                    <div class="item-id">
                        <span class="label">Asignado a: </span>
                        <span class="content">Iván Maldonado</span>
                    </div>
                    <div class="item-id">
                        <span class="label">Cliente: </span>
                        <span class="content">Halfonso Fernandez</span>
                    </div>
                </div>
                <div class="order-fetch">
                    <div class="item-id">
                        <span class="label">Entrada: </span>
                        <span class="content">14/04/2019</span>
                    </div>
                    <div class="item-id">
                        <span class="label">Previsto: </span>
                        <span class="content">17/04/2019</span>
                    </div>
                </div>
                <div class="order-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </a>

        </div>
        
    </div>
    <?php
}


function showFixesTable(){
    ?>
    <div class="table-container">
        <table class="fixes-table">
           <tr class="header-responsive-mobile">
                <th>Arreglos</th>
            </tr>
            <tr class="header-responsive-desktop">
                <th>ID</th>
                <th>Arreglo</th>
                <th>Prenda</th>
                <th>Precio</th>
                <th>Activo</th>
                <th>Creado</th>
            </tr>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td><span class="responsive-label">Prenda</span>Vaquero</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td><span class="responsive-label">Prenda</span>Vaquero</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td><span class="responsive-label">Prenda</span>Vaquero</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td><span class="responsive-label">Prenda</span>Vaquero</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td><span class="responsive-label">Prenda</span>Vaquero</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
            </tr>           
        </table>
    </div>
    
    <?php
}


function showClothesTable(){
    ?>
    <div class="table-container">
        <table class="clothes-table">
           <tr class="header-responsive-mobile">
                <th>Prendas</th>
            </tr>
            <tr class="header-responsive-desktop">
                <th>ID</th>
                <th>Prenda</th>
                <th>Nº Arreglos</th>
                <th>Activo</th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td class="clothe"><span class="responsive-label">Prenda</span>Vaqueros</td>
                <td class="num-fixes a-center"><span class="responsive-label">NºAreglos</span>2</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000002</a></td>
                <td class="clothe"><span class="responsive-label">Prenda</span>Jersei</td>
                <td class="num-fixes a-center"><span class="responsive-label">NºAreglos</span>1</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000003</a></td>
                <td class="clothe"><span class="responsive-label">Prenda</span>Camisa</td>
                <td class="num-fixes a-center"><span class="responsive-label">NºAreglos</span>8</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000004</a></td>
                <td class="clothe"><span class="responsive-label">Prenda</span>Mantel</td>
                <td class="num-fixes a-center"><span class="responsive-label">NºAreglos</span>5</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000005</a></td>
                <td class="clothe"><span class="responsive-label">Prenda</span>Pantalon Pana</td>
                <td class="num-fixes a-center"><span class="responsive-label">NºAreglos</span>7</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
            </tr>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000006</a></td>
                <td class="clothe"><span class="responsive-label">Prenda</span>Falda</td>
                <td class="num-fixes a-center"><span class="responsive-label">NºAreglos</span>1</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
            </tr>        
        </table>
    </div>
    
    <?php
}


function showOrdersTable(){
    ?>
    <div class="table-container">
        <table class="orders-table">
           <tr class="header-responsive-mobile">
                <th>Órdenes</th>
            </tr>
            <tr class="header-responsive-desktop">
                <th>ID</th>
                <th>Estado</th>
                <th>Prendas</th>
                <th>Precio</th>
                <th>Asignado a</th>
                <th>Cliente</th>
                <th>Entrada</th>
                <th>Previsto</th>
                <th>Terminado</th>
                <th>Entregado</th>
                <th>Actualizado</th>
                <th>Descripción</th>
            </tr>
            <tr class="order pending">
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Estado</span> <a href="" class="label-box pending"> Pendiente</a></td>
                <td class="a-center"><span class="responsive-label">Nº Prendas</span> 2</td>
                <td class="a-center"><span class="responsive-label">Precio</span> 10€</td>
                <td><span class="responsive-label">Asignado a</span> <a href="">Iván Maldonado</a></td>
                <td><span class="responsive-label">Cliente</span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="responsive-label">Entrada</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Previsto</span> 20/04/2019 13:00</td>
                <td class="date hidden"><span class="responsive-label">Terminado</span> -</td>
                <td class="date hidden"><span class="responsive-label">Entregado</span> -</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
                <td class="desc"><span class="desc-cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></td>
            </tr>
            <tr class="order working">
                <td><span class="responsive-label">ID</span> <a href="">000002</a></td>
                <td><span class="responsive-label">Estado</span> <a href="" class="label-box working">En proceso</a></td>
                <td class="a-center"><span class="responsive-label">Nº Prendas</span> 3</td>
                <td class="a-center"><span class="responsive-label">Precio</span> 12.50€</td>
                <td><span class="responsive-label">Asignado a</span> <a href="">Iván Maldonado</a></td>
                <td><span class="responsive-label">Cliente</span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="responsive-label">Entrada</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Previsto</span> 20/04/2019 13:00</td>
                <td class="date hidden"><span class="responsive-label">Terminado</span> -</td>
                <td class="date hidden"><span class="responsive-label">Entregado</span> -</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 18/04/2019 13:00</td>
                <td class="desc"><span class="desc-cont">Lorem ipsum dolor sit amet.</span></td>
            </tr>
            <tr class="order finished">
                <td><span class="responsive-label">ID</span> <a href="">000003</a></td>
                <td><span class="responsive-label">Estado</span> <a href="" class="label-box finished">Terminado</a></td>
                <td class="a-center"><span class="responsive-label">Nº Prendas</span> 5</td>
                <td class="a-center"><span class="responsive-label">Precio</span> 52€</td>
                <td><span class="responsive-label">Asignado a</span> <a href="">Iván Maldonado</a></td>
                <td><span class="responsive-label">Cliente</span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="responsive-label">Entrada</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Previsto</span> 20/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Terminado</span> 19/04/2019 13:00</td>
                <td class="date hidden"><span class="responsive-label">Entregado</span> -</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 19/04/2019 13:00</td>
                <td class="desc"><span class="desc-cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</span></td>
            </tr>
            <tr class="order out">
                <td><span class="responsive-label">ID</span> <a href="">000004</a></td>
                <td><span class="responsive-label">Estado</span> <a href="" class="label-box out"> Recogido</a></td>
                <td class="a-center"><span class="responsive-label">Nº Prendas</span> 1</td>
                <td class="a-center"><span class="responsive-label">Precio</span> 8€</td>
                <td><span class="responsive-label">Asignado a</span> <a href="">Iván Maldonado</a></td>
                <td><span class="responsive-label">Cliente</span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="responsive-label">Entrada</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Previsto</span> 20/04/2019 13:00</td>
                <td class="date hidden"><span class="responsive-label">Terminado</span> 19/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Entregado</span> 20/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 20/04/2019 13:00</td>
                <td class="desc"><span class="desc-cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</span></td>
            </tr>
            <tr class="order pending">
                <td><span class="responsive-label">ID</span> <a href="">000005</a></td>
                <td><span class="responsive-label">Estado</span> <a href="" class="label-box pending"> Pendiente</a></td>
                <td class="a-center"><span class="responsive-label">Nº Prendas</span> 7</td>
                <td class="a-center"><span class="responsive-label">Precio</span> 52€</td>
                <td><span class="responsive-label">Asignado a</span> <a href="">Iván Maldonado</a></td>
                <td><span class="responsive-label">Cliente</span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="responsive-label">Entrada</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Previsto</span> 20/04/2019 13:00</td>
                <td class="date hidden"><span class="responsive-label">Terminado</span> -</td>
                <td class="date hidden"><span class="responsive-label">Entregado</span> -</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
                <td class="desc"><span class="desc-cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></td>
            </tr>
            <tr class="order pending">
                <td><span class="responsive-label">ID</span> <a href="">000006</a></td>
                <td><span class="responsive-label">Estado</span> <a href="" class="label-box pending"> Pendiente</a></td>
                <td class="a-center"><span class="responsive-label">Nº Prendas</span> 1</td>
                <td class="a-center"><span class="responsive-label">Precio</span> 2€</td>
                <td><span class="responsive-label">Asignado a</span> <a href="">Iván Maldonado</a></td>
                <td><span class="responsive-label">Cliente</span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="responsive-label">Entrada</span> 17/04/2019 13:00</td>
                <td class="date"><span class="responsive-label">Previsto</span> 20/04/2019 13:00</td>
                <td class="date hidden"><span class="responsive-label">Terminado</span> -</td>
                <td class="date hidden"><span class="responsive-label">Entregado</span> -</td>
                <td class="date"><span class="responsive-label">Actualizado</span> 17/04/2019 13:00</td>
                <td class="desc"><span class="desc-cont">Lorem ipsum dolor sit amet</span></td>
            </tr>        
        </table>
    </div>
    
    <?php
}
function showUsersTable(){
    ?>
    <div class="table-container">
        <table class="user-table">
           <tr class="header-responsive-mobile">
                <th>Usuarios</th>
            </tr>
            <tr class="header-responsive-desktop">
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Registrado</th>
                <th>Activo</th>
                <th>Actualizado</th>
            </tr>
            <tr class="user">
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Ivan</a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box admin">Administrador</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href=""> Iván</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href=""> Maldonado</a></td>
                <td class="email"><span class="responsive-label">Correo</span> ivanmaldonado@dondedal.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
            <tr class="user">
                <td class="id"><span class="responsive-label">ID</span> <a href="">000002</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Eustaquio</a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box employee">Empleado</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href="">Eustaquio</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href="">Martinez</a></td>
                <td class="email"><span class="responsive-label">Correo</span> eustaquio@dondedal.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
            <tr class="user">
                <td class="id"><span class="responsive-label">ID</span> <a href="">000003</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Halfonso</a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box client">Cliente</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href=""> Halfonso</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href=""> Fernandez</a></td>
                <td class="email"><span class="responsive-label">Correo</span> gmail@halfonso.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
            <tr class="user">
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Ivan</a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box admin">Administrador</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href=""> Iván</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href=""> Maldonado</a></td>
                <td class="email"><span class="responsive-label">Correo</span> ivanmaldonado@dondedal.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
            <tr class="user">
                <td class="id"><span class="responsive-label">ID</span> <a href="">000002</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Eustaquio</a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box employee">Empleado</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href="">Eustaquio</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href="">Martinez</a></td>
                <td class="email"><span class="responsive-label">Correo</span> eustaquio@dondedal.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
            <tr class="user">
                <td class="id"><span class="responsive-label">ID</span> <a href="">000003</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Halfonso</a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box client">Cliente</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href=""> Halfonso</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href=""> Fernandez</a></td>
                <td class="email"><span class="responsive-label">Correo</span> gmail@halfonso.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
            <tr class="user">
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Ivan</a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box admin">Administrador</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href=""> Iván</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href=""> Maldonado</a></td>
                <td class="email"><span class="responsive-label">Correo</span> ivanmaldonado@dondedal.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
            <tr class="user">
                <td class="id"><span class="responsive-label">ID</span> <a href="">000002</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Eustaquio</a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box employee">Empleado</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href="">Eustaquio</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href="">Martinez</a></td>
                <td class="email"><span class="responsive-label">Correo</span> eustaquio@dondedal.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
            <tr class="user">
                <td class="id"><span class="responsive-label">ID</span> <a href="">000003</a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href=""> Halfonso</a></td> 
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box client">Cliente</a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href=""> Halfonso</a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href=""> Fernandez</a></td>
                <td class="email"><span class="responsive-label">Correo</span> gmail@halfonso.com</td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span> 17/04/2019 12:38</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span> 17/04/2019 12:38</td>
            </tr>
        </table>
    </div>
    
    <?php
}


function showPaginator(){
    ?>
    <div class="paginator">
        <a class="page previous" href="">&#60;</a>
        <a class="page" href="">1</a>
        <a class="page disabled">...</a>
        <a class="page" href="">3</a>
        <a class="page" href="">4</a>
        <a class="page" href="">5</a>
        <a class="page actual">6</a>
        <a class="page" href="">7</a>
        <a class="page" href="">8</a>
        <a class="page" href="">9</a>
        <a class="page disabled">...</a>
        <a class="page" href="">12</a>
        <a class="page next" href="">&#62;</a>
    </div>
    <?php
}