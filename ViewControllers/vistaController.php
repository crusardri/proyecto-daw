<?php

/**
 * Muestra el select Ordenar por
 * 
 * @param String[] $filters             Array de filtros
 */
function showOrderByFilter($filters){
    global $orderBy;
    ?>
    <label class="boxed-select" id="order-by-filter">
        <div>Ordenar por</div>
        <select data-class="order-by-filter" name="orderBy">
            <option value="-1">Ninguno</option>
            <?php
            for($i = 0; $i < sizeof($filters); $i++){
                ?>
            <option value="<?=$i?>" <?=$orderBy == $i ? "selected" : ""?>><?=$filters[$i]?></option>
                <?php
            }  
            
            ?>         
        </select>
    </label>
    <?php
}

/**
* Muestra el Select del filtro de estado
*/
function showStateFilter(){
    global $state;
    ?>
    <label class="boxed-select" id="active-filter">
        <div>Estado</div>
        <select data-class="labeled" name="state">
            <option value="-1">Todos</option>
            <option value="1" data-class="enabled" <?=$state == 1 ? "selected" : "" ?>>Activado</option>
            <option value="0" data-class="disabled" <?=$state == 0 ? "selected" : "" ?>>Desactivado</option>
        </select>
    </label>
    <?php
}

/**
* Muestra el Select del filtro order-direction
*/
function showOrderDirectionFilter(){
    global $orderDirection;
    ?>
    <label class="boxed-select" id="order-direction-filter">
        <div>Orden</div>
        <select data-class="order-direction-filter" name="orderDirection">
            <option value="0" <?=$orderDirection == 0 ? "selected" : ""?>>Ascendente</option>
            <option value="1" <?=$orderDirection == 1 ? "selected" : ""?>>Descendente</option>
        </select>
    </label>
    <?php
}


function showPaginator($baseURL, $actualPage, $totalItems, $urlParams, $itemsPerPage = 20){
    $totalPages = ceil($totalItems / $itemsPerPage);
    $paginatorFillPages = 4;
    if($totalPages > 1){
        ?>
        <div class="paginator">
        <?php
        //Pagina atras
        if($actualPage > 1){
            $urlParams["page"] = $actualPage - 1;
            ?>
            <a class="page previous" href="<?=$baseURL . http_build_query($urlParams)?>">&#60;</a>
            <?php
        }
        //Primera página
        if($actualPage > 1){
            $urlParams["page"] = 1;
            ?>
            <a class="page" href="<?=$baseURL . http_build_query($urlParams)?>"><?=$urlParams["page"]?></a>
            <?php
        }
        //Separador
        if($actualPage > $paginatorFillPages + 2){
            ?>
            <a class="page disabled">...</a>
            <?php
        }
        //Paginas anteriores
        for($i = $paginatorFillPages; $i > 0; $i--){
            $urlParams["page"] = $actualPage - $i;
            if($urlParams["page"] > 1){  
            ?> 
            <a class="page" href="<?=$baseURL . http_build_query($urlParams)?>"><?=$urlParams["page"]?></a>
            <?php
            }
        }
        //Página actual
        ?>
        <a class="page actual"><?=$actualPage?></a>
        <?php
        //Páginas posteriores
        for($i = 0; $i < $paginatorFillPages; $i++){
            $urlParams["page"] = $actualPage + $i + 1;
            if($urlParams["page"] < $totalPages){
            ?> 
            <a class="page" href="<?=$baseURL . http_build_query($urlParams)?>"><?=$urlParams["page"]?></a>
            <?php
            }
        }
        //Separador
        if($actualPage < $totalPages -  $paginatorFillPages - 1){
            ?>
            <a class="page disabled">...</a>
            <?php
        }
        //Ultima página
        if($actualPage < $totalPages){
            $urlParams["page"] = $totalPages;
            ?>
            <a class="page" href="<?=$baseURL . http_build_query($urlParams)?>"><?=$urlParams["page"]?></a>
            <?php
        }
        //Pagina adelante
        if($actualPage < $totalPages){
            $urlParams["page"] = $actualPage + 1;
            ?>
            <a class="page next" href="<?=$baseURL . http_build_query($urlParams)?>">&#62;</a>
            <?php
        }
        ?>
        </div>
        <?php
    }
    ?>
    <?php
    
}