<?php
// Incluye la conexión a la base de datos
include 'db.php';

// Consulta para obtener los datos de cliente y coordenadas
$sql = "SELECT cl.id_cliente, cl.cuit, cl.email, cl.direccion, cl.alias, cl.cbu, c.longitud, c.latitud 
        FROM cliente cl
        INNER JOIN coordenadas c ON cl.id_coordenada = c.id_coordenada";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
    <title>Cliente</title>
    <style>
        .tabla {
            max-height: 400px;
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

        .cell {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px; /* Ajusta el ancho deseado */
        }

        .cell:hover {
            overflow: visible;
            white-space: normal;
        }

        .cell[title] {
            cursor: pointer;
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

    <h1>MENÚ CLIENTE</h1>
    <div class="container">
        <div class="izquierda">
            <div class="busqueda">
                <p>
                    <input type="text" name="introducir_id" id="id" required placeholder="Introducir id">
                </p>
                <button type="button" id="buscar" onclick="location.href=''">BUSCAR</button>
                <button type="button" id="crear" onclick="location.href='clienteCrear.php'">CREAR NUEVO CLIENTE</button>
            </div> 
                <img src="logo.png" alt="logo" class="logo">
        </div>    
        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Cuit</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th>Alias</th>
                        <th>CBU</th>
                        <th>Longitud</th>
                        <th>Latitud</th>
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
                                <td class='cell' title='" . htmlspecialchars($row['id_cliente']) . "'>" . htmlspecialchars($row['id_cliente']) . "</td>
                                <td class='cell' title='" . htmlspecialchars($row['cuit']) . "'>" . htmlspecialchars($row['cuit']) . "</td>
                                <td class='cell' title='" . htmlspecialchars($row['email']) . "'>" . htmlspecialchars($row['email']) . "</td>
                                <td class='cell' title='" . htmlspecialchars($row['direccion']) . "'>" . htmlspecialchars($row['direccion']) . "</td>
                                <td class='cell' title='" . htmlspecialchars($row['alias']) . "'>" . htmlspecialchars($row['alias']) . "</td>
                                <td class='cell' title='" . htmlspecialchars($row['cbu']) . "'>" . htmlspecialchars($row['cbu']) . "</td>
                                <td class='cell' title='" . htmlspecialchars($row['longitud']) . "'>" . htmlspecialchars($row['longitud']) . "</td>
                                <td class='cell' title='" . htmlspecialchars($row['latitud']) . "'>" . htmlspecialchars($row['latitud']) . "</td>
                                <td>
                                    <a href='clienteModificar.php?id={$row['id_cliente']}'>
                                        <img src='avatar-de-usuario.png' alt='Modificar' class='icono-accion'>
                                    </a>
                                </td>
                                <td>
                                    <a href='clienteEliminar.php?id={$row['id_cliente']}'>
                                        <img src='borrar-usuario.png' alt='Eliminar' class='icono-accion'>
                                    </a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No hay clientes disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>