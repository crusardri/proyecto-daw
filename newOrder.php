<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva Orden</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <form>
       <label class="boxed-radio">
            <input type="radio" name="estate" name="1">
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title">Por Defecto</div>
                <div class="radio-desc">Por defecto.</div>
            </div>
        </label>
        <label class="boxed-radio">
            <input type="radio" name="estate" name="1">
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title">Por Defecto</div>
                <div class="radio-desc">Por defecto.</div>
            </div>
        </label>
        <label class="boxed-radio active">
            <input type="radio" name="estate" name="1">
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title">Activo</div>
                <div class="radio-desc">El usuario puede iniciar sesión en la aplicación y utilizar todas sus funciones.</div>
            </div>
        </label>
        <label class="boxed-radio disabled">
            <input type="radio" name="estate" name="1" checked>
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title">Desactivado</div>
                <div class="radio-desc">El usuario no podrá iniciar sesión, todos sus datos se mantendran en la aplicación para consulta.</div>
            </div>
        </label>
        
        <label class="boxed-radio pending">
            <input type="radio" name="estate" name="1">
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
        <label class="boxed-radio client">
            <input type="radio" name="estate" name="1">
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title">Cliente</div>
                <div class="radio-desc">Nivel de usuario que solo permite relaccionar sus órdenes.</div>
            </div>
        </label>
        <label class="boxed-radio employee">
            <input type="radio" name="estate" name="1">
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title">Empleado</div>
                <div class="radio-desc">Nivel de usuario que permite crear y modificar ordenes y usuarios.</div>
            </div>
        </label>
        <label class="boxed-radio admin">
            <input type="radio" name="estate" name="1">
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title">Administrador</div>
                <div class="radio-desc">Nivel de usuario que da control total sobre la aplicación.</div>
            </div>
        </label>
    </form>
</body>
</html>