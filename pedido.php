<?php
// Incluye la conexión a la base de datos
include 'db.php';
//MODIFICARRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR 
// Consulta a la base de datos
$sql = "SELECT id_pedido, estado, id_cliente, id_vendedor, id_pago, metodo_pago FROM pedido";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
    <title>Pedido</title>
    <style>
        .tabla {
            max-height: 350px;
            overflow-y: auto;
            max-width: 900px;
            left: 350px;
            position: absolute;
            width: 100%; /* Ajustar al ancho del contenedor */
            border-collapse: collapse; /* Eliminar el espacio entre bordes */
            text-align: center; /* Centrar el texto en las celdas */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .tabla tbody {
            display: block;
            max-height: 400px;
            overflow-y: auto;
        }

        .tabla thead, .tabla tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed; /* Asegura que las columnas tengan el mismo ancho */
        }
    </style>
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

    <h1>MENÚ PEDIDO</h1>
    <div class="container">
        <div class="izquierda">
            <div class="busqueda">
                <p>
                    <input type="text" name="introducir_id" id="id" required placeholder="Introducir id">
                </p>
                <button type="button" id="buscar" onclick="location.href=''">BUSCAR</button>
                <button type="button" id="crear" onclick="location.href='pedidoCrear.php'">CREAR NUEVO PEDIDO</button>
            </div> 
                <img src="logo.png" alt="logo" class="logo">
        </div>    
        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Estado</th>
                        <th>Pago</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verifica si hay resultados
                    if ($result->num_rows > 0) {
                        // Genera filas dinámicamente
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id_pedido']}</td>
                                <td>{$row['id_cliente']}</td>
                                <td>{$row['id_vendedor']}</td>
                                <td>" . htmlspecialchars($row['estado']) . "</td>
                                <td>{$row['id_pago']}</td>
                                <td>
                                    <a href='vendedorModificar.php?id={$row['id_pedido']}'>
                                        <img src='avatar-de-usuario.png' alt='Modificar' class='icono-accion'>
                                    </a>
                                </td>
                                <td>
                                    <a href='vendedorEliminar.php?id={$row['id_pedido']}'>
                                        <img src='borrar-usuario.png' alt='Eliminar' class='icono-accion'>
                                    </a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay vendedores disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>