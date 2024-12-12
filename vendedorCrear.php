<?php
// Incluye la conexión a la base de datos
include 'db.php';

// Consulta para obtener los nombres de los productos de la tabla itemmenu
$sql = "SELECT id_itemMenu, nombre FROM itemmenu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crear.css">
    <style>
        /* Estilo para limitar el alto de la lista con scroll */
        #productos {
            max-height: 150px; /* Altura máxima (aprox. 6 productos) */
            overflow-y: auto; /* Scroll vertical */
            border: 1px solid #ccc; /* Opcional: añadir un borde */
            padding: 10px;
            list-style: none; /* Quitar el estilo de lista predeterminado */
        }
        #productos li {
            margin: 5px 0; /* Separación entre elementos */
        }
    </style>
    <title>Crear Vendedor</title>
</head>
<body>
<header class="header">
        <ul class="menu-ul">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="vendedor1.php">Menú Vendedor</a></li>
            <li><a href="cliente.php">Menú Cliente</a></li>
            <li><a href="pedido.php">Menú Pedido</a></li>
            <li><a href="itemMenu.php">Menú Item menu</a></li>
        </ul>
    </header>

    <h1>CREAR NUEVO VENDEDOR</h1>
    <div class="container">

        <img src="logo.png" alt="logo" class="logo">
        
        <div class="entradas">
            <p>
                <label for="nombre*" class="colocar_nombre">Nombre</label>
                <input type="text" name="introducir_nombre" id="nombre" required placeholder="Escribe su nombre">
            </p>
            <p>
                <label for="direccion*" class="colocar_direccion">Dirección:</label>
                <input type="text" name="introducir_direccion" id="direccion" required placeholder="Escribe su direccion">
            </p>
            <p>
                <label for="coordenadasLat*" class="colocar_latitud">Latitud de coordenada:</label>
                <input type="text" name="introducir_latitud" id="latitud" required placeholder="Latitud">
            </p>
            <p>
                <label for="coordenadasLong*" class="colocar_longitud">Longitud de coordenada:</label>
                <input type="text" name="introducir_longitud" id="longitud" required placeholder="Longitud">
            </p>
        </div>

        <div id="productos-lista">
            <label for="productos">Selecciona productos:</label>
            <ul id="productos">
                <?php
                // Verifica si hay resultados y genera la lista dinámicamente
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li><input type="checkbox" value="' . $row['id_itemMenu'] . '"> ' . htmlspecialchars($row['nombre']) . '</li>';
                    }
                } else {
                    echo '<li>No hay productos disponibles</li>';
                }
                ?>
            </ul>
            <button id="agregar">Agregar al Vendedor</button>
        </div>

        <div class="botones-acep-cancel">
            <button class="btn-cancelar" type="button" id="cancelar">Cancelar</button>
            <button class="btn-aceptar" type="button" id="crear" onclick="">Crear</button>
        </div>
    </div>
</body>
</html>
