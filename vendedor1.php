<?php
// Incluye la conexión a la base de datos
include 'db.php';

// Consulta para obtener los datos de vendedor y coordenadas
$sql = "SELECT v.id_vendedor, v.nombre, v.direccion, c.longitud, c.latitud 
        FROM vendedor v
        INNER JOIN coordenadas c ON v.id_coordenada = c.id_coordenada";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendedor.css">
    <title>Vendedor</title>
    <style>

        .tabla {
            max-height: 400px; /* Altura máxima de 5 filas (aproximadamente) */
            overflow-y: auto; /* Scroll vertical si hay más filas */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <header class="header">
        <ul class="menu-ul">
            <li><a href="index.html">Inicio</a></li>
            <li><a href="cliente.html">Menú Cliente</a></li>
            <li><a href="pedido.html">Menú Pedido</a></li>
            <li><a href="itemMenu.html">Menú Item menu</a></li>
        </ul>
    </header>

    <h1>MENÚ VENDEDOR</h1>
    <div class="container">
        <div class="izquierda">
            <div class="busqueda">
                <p>
                    <input type="text" name="introducir_id" id="id" required placeholder="Introducir id">
                </p>
                <button type="button" id="buscar" onclick="location.href=''">BUSCAR</button>
                <button type="button" id="crear" onclick="location.href='vendedorCrear.html'">CREAR NUEVO VENDEDOR</button>
            </div> 
                <img src="logo.png" alt="logo" class="logo">
        </div>    
        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
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
                                <td>{$row['id_vendedor']}</td>
                                <td>" . htmlspecialchars($row['nombre']) . "</td>
                                <td>" . htmlspecialchars($row['direccion']) . "</td>
                                <td>{$row['longitud']}</td>
                                <td>{$row['latitud']}</td>
                                 <td>
                                    <a href='vendedorModificar.php?id={$row['id_vendedor']}'>
                                        <img src='avatar-de-usuario.png' alt='Modificar' class='icono-accion'>
                                    </a>
                                </td>
                                <td>
                                    <a href='vendedorEliminar.php?id={$row['id_vendedor']}'>
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
