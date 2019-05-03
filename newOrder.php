<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva Orden</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="form-container new-order">
        <h1>Nueva órden</h1>
        <form>
            <label class="boxed-input id">
                <div class="text-label">ID</div>
                <input type="number" value="000001" disabled>
            </label>
            <label class="boxed-input worker">
                <div class="text-label">Número de prendas</div>
                <input type="number" value="3" disabled>
                <div class="button">Buscar</div>
            </label>
            
            
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
            <label class="boxed-radio canceled">
                <input type="radio" name="estate" name="1">
                <div class="container">
                    <div class="radio-checkbox">&#x2713;</div>
                    <div class="radio-title">Cancelado</div>
                    <div class="radio-desc">La orden ha sido cancelada.</div>
                </div>
            </label>
        </form>
    </div>
</body>
</html>