<?php
require 'db.php'; // Incluye la conexión a la base de datos

// Consulta a la base de datos
$sql = "SELECT id_pedido, estado, id_cliente, id_vendedor, id_pago, metodo_pago FROM pedido";
$result = $conn->query($sql);

$pedidos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
}

// Retorna los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($pedidos);

$conn->close();
?>
