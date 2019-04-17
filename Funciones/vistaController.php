<?php
function showOrdersShowcase($titulo){
    ?>
    <div class="showcase order-showcase">
        <div class="title"><?=$titulo?><a class="button" href="">Ver todas</a></div>
        <div class="order-container">
            <a href="" class="order-item pending">
                <div class="estate pending"></div>
                <div class="order-info">
                    <div class="item-id">
                        <span class="label">ID: </span>
                        <span class="content">000001</span>
                    </div>
                    <div class="item-id">
                        <span class="label">Estado: </span>
                        <span class="content estate-name pending">Pendiente</span>
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



function showOrdersTable(){
    ?>
        <table class="order-table">
           <tr class="header-res">
                <th>Órdenes</th>
            </tr>
            <tr class="header">
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
                <td><span class="label">ID: </span> <a href="">000001</a></td>
                <td><span class="label">Estado: </span> <a href="" class="estate-name pending"> Pendiente</a></td>
                <td class="center"><span class="label">Nº Prendas: </span> 2</td>
                <td class="center"><span class="label">Precio: </span> 10€</td>
                <td><span class="label">Asignado a: </span> <a href="">Iván Maldonado</a></td>
                <td><span class="label">Cliente: </span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="label">Entrada: </span> 17/04/2019</td>
                <td class="date"><span class="label">Previsto: </span> 20/04/2019</td>
                <td class="date"><span class="label">Terminado: </span> -</td>
                <td class="date"><span class="label">Entregado: </span> -</td>
                <td class="date"><span class="label">Actualizado: </span> 17/04/2019</td>
                <td class="desc"><span class="label">Descripción: </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
            </tr>
            <tr class="order working">
                <td><span class="label">ID: </span> <a href="">000002</a></td>
                <td><span class="label">Estado: </span> <a href="" class="estate-name working">En proceso</a></td>
                <td class="center"><span class="label">Nº Prendas: </span> 3</td>
                <td class="center"><span class="label">Precio: </span> 12.50€</td>
                <td><span class="label">Asignado a: </span> <a href="">Iván Maldonado</a></td>
                <td><span class="label">Cliente: </span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="label">Entrada: </span> 17/04/2019</td>
                <td class="date"><span class="label">Previsto: </span> 20/04/2019</td>
                <td class="date"><span class="label">Terminado: </span> -</td>
                <td class="date"><span class="label">Entregado: </span> -</td>
                <td class="date"><span class="label">Actualizado: </span> 18/04/2019</td>
                <td class="desc"><span class="label">Descripción: </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
            </tr>
            <tr class="order finished">
                <td><span class="label">ID: </span> <a href="">000003</a></td>
                <td><span class="label">Estado: </span> <a href="" class="estate-name finished">Terminado</a></td>
                <td class="center"><span class="label">Nº Prendas: </span> 5</td>
                <td class="center"><span class="label">Precio: </span> 52€</td>
                <td><span class="label">Asignado a: </span> <a href="">Iván Maldonado</a></td>
                <td><span class="label">Cliente: </span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="label">Entrada: </span> 17/04/2019</td>
                <td class="date"><span class="label">Previsto: </span> 20/04/2019</td>
                <td class="date"><span class="label">Terminado: </span> 19/04/2019</td>
                <td class="date"><span class="label">Entregado: </span> -</td>
                <td class="date"><span class="label">Actualizado: </span> 19/04/2019</td>
                <td class="desc"><span class="label">Descripción: </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
            </tr>
            <tr class="order out">
                <td><span class="label">ID: </span> <a href="">000004</a></td>
                <td><span class="label">Estado: </span> <a href="" class="estate-name out"> Recogido</a></td>
                <td class="center"><span class="label">Nº Prendas: </span> 1</td>
                <td class="center"><span class="label">Precio: </span> 8€</td>
                <td><span class="label">Asignado a: </span> <a href="">Iván Maldonado</a></td>
                <td><span class="label">Cliente: </span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="label">Entrada: </span> 17/04/2019</td>
                <td class="date"><span class="label">Previsto: </span> 20/04/2019</td>
                <td class="date"><span class="label">Terminado: </span> 19/04/2019</td>
                <td class="date"><span class="label">Entregado: </span> 20/04/2019</td>
                <td class="date"><span class="label">Actualizado: </span> 20/04/2019</td>
                <td class="desc"><span class="label">Descripción: </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
            </tr>
            <tr class="order pending">
                <td><span class="label">ID: </span> <a href="">000005</a></td>
                <td><span class="label">Estado: </span> <a href="" class="estate-name pending"> Pendiente</a></td>
                <td class="center"><span class="label">Nº Prendas: </span> 7</td>
                <td class="center"><span class="label">Precio: </span> 52€</td>
                <td><span class="label">Asignado a: </span> <a href="">Iván Maldonado</a></td>
                <td><span class="label">Cliente: </span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="label">Entrada: </span> 17/04/2019</td>
                <td class="date"><span class="label">Previsto: </span> 20/04/2019</td>
                <td class="date"><span class="label">Terminado: </span> -</td>
                <td class="date"><span class="label">Entregado: </span> -</td>
                <td class="date"><span class="label">Actualizado: </span> 17/04/2019</td>
                <td class="desc"><span class="label">Descripción: </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
            </tr>
            <tr class="order pending">
                <td><span class="label">ID: </span> <a href="">000006</a></td>
                <td><span class="label">Estado: </span> <a href="" class="estate-name pending"> Pendiente</a></td>
                <td class="center"><span class="label">Nº Prendas: </span> 1</td>
                <td class="center"><span class="label">Precio: </span> 2€</td>
                <td><span class="label">Asignado a: </span> <a href="">Iván Maldonado</a></td>
                <td><span class="label">Cliente: </span> <a href="">Halfonso Fernández</a></td>
                <td class="date"><span class="label">Entrada: </span> 17/04/2019</td>
                <td class="date"><span class="label">Previsto: </span> 20/04/2019</td>
                <td class="date"><span class="label">Terminado: </span> -</td>
                <td class="date"><span class="label">Entregado: </span> -</td>
                <td class="date"><span class="label">Actualizado: </span> 17/04/2019</td>
                <td class="desc"><span class="label">Descripción: </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
            </tr>        
        </table>
    
    <?php
}