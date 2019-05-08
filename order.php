<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva Orden</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/single-view.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="form-container order">
        
        <form>
            <div class="order-info">
                <h1>Nueva órden</h1>
                <label class="boxed-input id">
                    <div class="text-label">ID</div>
                    <input type="number" value="000001" disabled>
                </label>
            </div>      
            <!-- User Info -->
            <div class="client-info">
                <div class="field-set">
                <h3>Cliente</h3>
                    <div class="info-set">
                        <div class="form-info-title">Identificador</div>
                        <div class="form-info-data">000001</div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Nombre de usuario</div>
                        <div class="form-info-data">Halfonso</div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Nombre</div>
                        <div class="form-info-data">Halfonso</div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Apellidos</div>
                        <div class="form-info-data">Fernandez</div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Correo Electronico</div>
                        <div class="form-info-data">gmail@halfonso.com</div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Telefono</div>
                        <div class="form-info-data">689966332</div>
                    </div>
                    <div class="button" id="search-client">Cambiar</div>
                </div>
            </div>
            <div class="employee-info">
                <div class="field-set">
                <h3>Empleado</h3>
                    <div class="info-set">
                        <div class="form-info-title">Identificador</div>
                        <div class="form-info-data">000002</div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Nombre de usuario</div>
                        <div class="form-info-data">Ivan</div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Nombre</div>
                        <div class="form-info-data">Iván</div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Apellidos</div>
                        <div class="form-info-data">Maldonado</div>
                    </div>
                    <div class="button" id="search-employee">Cambiar</div>
                </div>
            </div>
             
            <!-- Estados -->
            
            <div class="estate-container">
               <h2>Estado</h2>
                <label class="boxed-radio pending">
                    <input type="radio" name="estate" name="1" checked>
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Pendiente</div>
                        <div class="radio-desc">La orden ha sido recibida y esta en espera.</div>
                    </div>
                </label>
                <label class="boxed-radio working">
                    <input type="radio" name="estate" name="1">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">En proceso</div>
                        <div class="radio-desc">La orden esta realizandose.</div>
                    </div>
                </label>
                <label class="boxed-radio finished">
                    <input type="radio" name="estate" name="1">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Finalizado</div>
                        <div class="radio-desc">La orden ha sido terminada y esta pendiente de recogida.</div>
                    </div>
                </label>
                <label class="boxed-radio out">
                    <input type="radio" name="estate" name="1">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Entregado</div>
                        <div class="radio-desc">La orden ha sido recogida.</div>
                    </div>
                </label>
                <label class="boxed-radio canceled full-width">
                    <input type="radio" name="estate" name="1">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Cancelado</div>
                        <div class="radio-desc">La orden ha sido cancelada.</div>
                    </div>
                </label>
            </div>
            
        </form>
    </div>
</body>
</html>