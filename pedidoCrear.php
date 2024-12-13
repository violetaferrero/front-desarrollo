<?php
// Incluye la conexión a la base de datos
include 'db.php';

// Consulta para obtener los clientes (id_cliente, cuit)
$sqlClientes = "SELECT id_cliente, cuit FROM cliente";
$resultClientes = $conn->query($sqlClientes);

// Consulta para obtener los vendedores (id_vendedor, nombre)
$sqlVendedores = "SELECT id_vendedor, nombre FROM vendedor";
$resultVendedores = $conn->query($sqlVendedores);

// Consulta inicial para obtener los ítems (vacía, depende del vendedor seleccionado más adelante)
$items = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crear.css">
    <style>
    #productos-lista {
        background-color: #f9fff2;
  border: 2px solid #b3ec68;
  border-radius: 8px;
  padding: 15px;
  margin: 10px 0;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  position: absolute;
  top: 150px;
  left: 850px;
  z-index: 1000;
  width: 300px;
  overflow-y: auto; /* Permite desplazamiento vertical si hay más contenido */
  max-height: 200px;

}

.hidden {
  display: none;
}

.show {
  display: block;
}


  #productos-lista label {
    font-size: 18px; /* Texto más destacado */
    font-weight: bold; /* Resalta el texto */
    color: #333; /* Texto oscuro para buena legibilidad */
    margin-bottom: 10px;
    display: inline-block; /* Mantiene alineación y separación */
  }

  #productos {
    list-style: none; /* Elimina los puntos de las listas */
    padding: 0; /* Quita padding del ul */
    margin: 0;
  }

  #productos li {
    padding: 10px; /* Espaciado interno */
    margin-bottom: 5px; /* Espaciado entre ítems */
    background-color: #b3ec68; /* Color predominante para destacar */
    color: #fff; /* Texto en blanco para contraste */
    border-radius: 5px; /* Esquinas redondeadas */
    cursor: pointer; /* Cambia a un cursor clickeable */
    transition: background-color 0.3s ease; /* Animación suave para hover */
  }

  #productos li:hover {
    background-color: #8fd456; /* Color más oscuro al pasar el ratón */
  }

  #productos li:active {
    background-color: #75b84c; /* Color más intenso al hacer clic */
  }
  select {
    width: 100%; /* Ajusta al tamaño completo del contenedor */
    padding: 10px;
    border: 2px solid #b3ec68; /* Borde en el color predominante */
    border-radius: 5px; /* Esquinas redondeadas */
    background-color: #f9fff2; /* Fondo claro que combine con el verde */
    color: #333; /* Texto oscuro para buena legibilidad */
    font-size: 16px; /* Tamaño del texto */
    appearance: none; /* Elimina el estilo predeterminado del navegador */
    background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 140 140"><polygon points="70,100 10,40 130,40" fill="%23b3ec68"/></svg>'); /* Flecha personalizada */
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
    cursor: pointer; /* Cambia el cursor al pasar por encima */
  }

  select:hover {
    border-color: #8fd456; /* Cambio de borde al pasar el ratón */
  }

  select:focus {
    outline: none;
    box-shadow: 0 0 5px 2px rgba(179, 236, 104, 0.5); /* Sombra en foco */
  }
    </style>
    <title>Crear Pedido</title>
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

<h1>CREAR NUEVO PEDIDO</h1>
<div class="container">
    <img src="logo.png" alt="logo" class="logo">

    <form action="guardar_pedido.php" method="POST">
        <div class="entradas">
            <p>
                <label for="cliente" class="colocar_cliente">Cliente:</label>
                <select name="id_cliente" id="cliente" required>
                    <option value="">Seleccione un cliente (Id - CUIT)</option>
                    <?php
                    if ($resultClientes->num_rows > 0) {
                        while ($row = $resultClientes->fetch_assoc()) {
                            echo '<option value="' . $row['id_cliente'] . '">' . htmlspecialchars($row['id_cliente'] . ' - ' . $row['cuit']) . '</option>';
                        }
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="vendedor" class="colocar_vendedor">Vendedor:</label>
                <select name="id_vendedor" id="vendedor" required>
                    <option value="">Seleccione un vendedor (Id - Nombre)</option>
                    <?php
                    if ($resultVendedores->num_rows > 0) {
                        while ($row = $resultVendedores->fetch_assoc()) {
                            echo '<option value="' . $row['id_vendedor'] . '">' . htmlspecialchars($row['id_vendedor'] . ' - ' . $row['nombre']) . '</option>';
                        }
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="metodo_pago" class="colocar_metodo_pago">Método de Pago:</label>
                <select name="metodo_pago" id="metodo_pago" required>
                    <option value="">Seleccione un método de pago</option>
                    <option value="MP">MercadoPago</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
            </p>
        </div>

        <div id="productos-lista">
            <label for="productos">Selecciona Items:</label>
            <ul id="productos">
                <!-- Aquí se rellenarán dinámicamente los ítems con JavaScript -->
            </ul>
        </div>

        <div class="espacio-blanco"></div>
        <div class="botones-acep-cancel">
            <button class="btn-cancelar" type="button" id="cancelar">Cancelar</button>
            <button class="btn-aceptar" type="submit">Crear</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('vendedor').addEventListener('change', function () {
        const vendedorId = this.value;
        const productosLista = document.getElementById('productos');

        // Limpia la lista de productos antes de cargar nuevos
        productosLista.innerHTML = '';

        if (vendedorId) {
            fetch(`get_items.php?id_vendedor=${vendedorId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.innerHTML = `<input type="checkbox" name="items[]" value="${item.id_itemMenu}"> ${item.nombre}`;
                            productosLista.appendChild(li);
                        });
                    } else {
                        productosLista.innerHTML = '<li>No hay productos disponibles</li>';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

</body>
</html>
