<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crear.css">
    <title>Crear Cliente</title>
</head>
<body>
        <header class="header">
                <ul class="menu-ul">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="vendedor.php">Menú Vendedor</a></li>
                    <li><a href="cliente.php">Menú Cliente</a></li>
                    <li><a href="pedido.php">Menú Pedido</a></li>
                    <li><a href="itemMenu.php">Menú Item menu</a></li>
                </ul>
            </header>

    <h1>CREAR NUEVO CLIENTE</h1>
    <div class="container">

        <img src="logo.png" alt="logo" class="logo">
        
        <div class="entradas">
        <p>
            <label for="direccion*" class="colocar_direccion">Dirección:</label>
            <input type="text" name="introducir_direccion" id="direccion" required placeholder="">
        </p>
        <p>
            <label for="CUIT*" class="colocar_cuit">CUIT:</label>
            <input type="text" name="introducir_CUIT" id="cuit" required placeholder="">
        </p>
        <p>
            <label for="email*" class="colocar_email">Email:</label>
            <input type="text" name="introducir_email" id="email" required placeholder="">
        </p>
        <p>
            <label for="alias*" class="colocar_alias">Alias:</label>
            <input type="text" name="introducir_alias" id="alias" required placeholder="">
        </p>
        <p>
            <label for="cbu*" class="colocar_cbu">CBU:</label>
            <input type="text" name="introducir_cbu" id="cbu" required placeholder="">
        </p>
    </div>
        <div class="tres-entrada">
            <p>
                <label for="coordenadasLat*" class="colocar_latitud">Latitud de coordenada:</label>
                <input type="text" name="introducir_latitud" id="latitud" required placeholder="">
            </p>
            <p>
                <label for="coordenadasLong*" class="colocar_longitud">Longitud de coordenada:</label>
                <input type="text" name="introducir_longitud" id="longitud" required placeholder="">
            </p>
            <div class="botones-acep-cancel">
                <button class="btn-cancelar" type="button" id="cancelar">Cancelar</button>
                <button class="btn-aceptar" type="button" id="crear" onclick="">Crear</button>
            </div>
        </div>
    </div>
</body>
</html>