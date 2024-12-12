<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crear.css">
    <link rel="stylesheet" href="menu.css">
    <title>Pedido</title>
    <style>
        /* Estilos básicos para el modal */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-y: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
            z-index: 2;
        }
        tbody {
            display: block;
            max-height: 300px; /* Limita a 12 filas aproximadamente */
            overflow-y: auto;
        }
        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        .input-field {
            width: calc(100% - 40px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-submit {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
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

<h1>MENÚ PEDIDO</h1>
<div class="container">
    <div class="botones-menu"> 
        <button type="button" id="crearPedido" onclick="location.href='pedidoCrear.php'">CREAR</button>
        <button type="button" id="buscarPedido" onclick="location.href='pedidoModificar.html'">MODIFICAR</button>
        <button type="button" id="eliminarPedido">ELIMINAR</button>
        <button type="button" id="listarPedido">LISTAR</button>
    </div>
    <img src="logo.png" alt="logo" class="logo">
</div>

<!-- Modal Listar -->
<div id="modalListar" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Lista de Pedidos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Estado</th>
                    <th>ID Cliente</th>
                    <th>ID Vendedor</th>
                    <th>ID Pago</th>
                    <th>Metodo Pago</th>
                </tr>
            </thead>
            <tbody id="tablaPedidos">
                <!-- Los datos se cargarán aquí dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Eliminar -->
<div id="modalEliminar" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Eliminar Pedido</h2>
        <input type="text" id="idEliminar" class="input-field" placeholder="Ingrese ID del Pedido">
        <button class="btn" id="buscarEliminar">Buscar</button>
        <button class="btn-danger" id="buscarEliminar">Eliminar</button>
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Estado</th>
                    <th>ID Cliente</th>
                    <th>ID Vendedor</th>
                    <th>ID Pago</th>
                    <th>Metodo Pago</th>
                </tr>
            </thead>
            <tbody id="tablaEliminar">
                <!-- Los datos se cargarán aquí dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById("listarPedido").addEventListener("click", function() {
        const modal = document.getElementById("modalListar");
        const tabla = document.getElementById("tablaPedidos");

        // Mostrar el modal
        modal.style.display = "block";

        // Cargar datos desde la base de datos
        fetch('listarPedidos.php')
            .then(response => response.json())
            .then(data => {
                tabla.innerHTML = '';
                data.forEach(pedido => {
                    const row = `<tr>
                        <td>${pedido.id_pedido}</td>
                        <td>${pedido.estado}</td>
                        <td>${pedido.id_cliente}</td>
                        <td>${pedido.id_vendedor}</td>
                        <td>${pedido.id_pago}</td>
                        <td>${pedido.metodo_pago}</td>
                    </tr>`;
                    tabla.innerHTML += row;
                });
            })
            .catch(error => console.error('Error:', error));
    });

    // Botón para eliminar pedidos
    document.getElementById("eliminarPedido").addEventListener("click", function() {
        const modal = document.getElementById("modalEliminar");
        modal.style.display = "block";
    });

    document.getElementById("buscarEliminar").addEventListener("click", function() {
    const id = document.getElementById("idEliminar").value.trim(); // Elimina espacios extra
    const tabla = document.getElementById("tablaEliminar");

    // Validar que el ID no esté vacío
    if (!id) {
        alert("Por favor ingresa un ID válido.");
        return; // Detener la ejecución si no hay un ID
    }

    console.log("Buscando pedido con ID:", id); // Verifica que el ID sea correcto

    // Realizar la búsqueda del pedido
    fetch(`buscarPedido.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            tabla.innerHTML = ''; // Limpiar la tabla antes de agregar los datos
            if (data) {
                // Si se encuentra el pedido, lo mostramos en la tabla
                const row = `<tr>
                    <td>${data.id_pedido}</td>
                    <td>${data.estado}</td>
                    <td>${data.id_cliente}</td>
                    <td>${data.id_vendedor}</td>
                    <td>${data.id_pago}</td>
                    <td>${data.metodo_pago}</td>
                </tr>`;
                tabla.innerHTML += row;
            } else {
                // Si no se encuentra el pedido, mostrar un mensaje en la tabla
                tabla.innerHTML = '<tr><td colspan="6">No se encontró el pedido</td></tr>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al realizar la búsqueda.');
        });
});



    // Cerrar los modales
    document.querySelectorAll(".close").forEach(button => {
        button.addEventListener("click", function() {
            button.closest(".modal").style.display = "none";
        });
    });

    // Cerrar el modal si se hace clic fuera del contenido
    window.onclick = function(event) {
        const modals = document.querySelectorAll(".modal");
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    };
</script>
</body>
</html>
