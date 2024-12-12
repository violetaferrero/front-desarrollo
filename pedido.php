<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crear.css">
    <link rel="stylesheet" href="menu.css">
    <title>Pedido</title>
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
            <button type="button" id="crearPedido" onclick="location.href='vendedorCrear.html'">CREAR</button>
            <button type="button" id="buscarPedido" onclick="location.href='pedidoModificar.html'">MODIFICAR</button>
            <button type="button" id="eliminarPedido" onclick="location.href='pedidoEliminar.html'">ELIMINAR</button>
            <button type="button" id="listarPedido" onclick="location.href='pedidoListar.html'">LISTAR</button>
    </div>
    <img src="logo.png" alt="logo" class="logo">
</div>
</body>
</html>