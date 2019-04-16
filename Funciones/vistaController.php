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