<?php include("./Funciones/vistaController.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usuario</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/single-view.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="form-container clothe">  
        <!-- Datos Cuenta -->
        <form id="clothe-info-container">
            <h1>Prenda</h1>
            <div class="field-set" id="clothe-infoset">
            <h3>Datos Prenda</h3>
               <label class="boxed-input" id="clothe-id">
                    <div class="text-label"><span>ID</span></div>
                    <div class="input-container">
                        <input type="text" value="000001" disabled>
                    </div>
                </label>
                <label class="boxed-input" id="clothe-name">
                    <div class="text-label"><span>Nombre Prenda</span></div>
                    <div class="input-container">
                        <input type="text" value="Vaqueros">
                    </div>
                </label>
                <label class="boxed-input" id="create-date">
                    <div class="text-label"><span>Fecha de creacion</span></div>
                    <div class="input-container">
                        <input type="text" value="13/05/2019 13:03:24" disabled>
                    </div>
                </label>
                <label class="boxed-input" id="update-date">
                    <div class="text-label"><span>Fecha de actualizacion</span></div>
                    <div class="input-container">
                        <input type="text" value="13/05/2019 13:03:24" disabled>
                    </div>
                </label>
                <div class="form-buttons">
                    <input type="submit" value="Cambiar Nombre" class="input-submit-button">
                </div>
            </div>
            
        </form>
        <!-- Estados -->
        <form id="active-container">
            <h2>Estado</h2>
            <div>
                <label class="boxed-radio active">
                    <input type="radio" name="active" value="1" checked>
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Activado</div>
                        <div class="radio-desc">Aparecerá en los listados y estará disponible para añadir en nuevas órdenes.</div>
                    </div>
                </label>
                <label class="boxed-radio disabled">
                    <input type="radio" name="active" value="0">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Desactivado</div>
                        <div class="radio-desc">No se podrá añadir a nuevas órdenes, pero se mantendrán en órdenes antiguas para consulta.</div>
                    </div>
                </label>
            </div>
            
            <div class="form-buttons">
                <input type="submit" value="Actualizar estado" class="input-submit-button">
            </div>
        </form>
        <!-- Tabla Arreglos -->
        <div id="fixes-table">
            <?php showFixesTable(); ?>
        </div>
    </div>
</body>
</html>