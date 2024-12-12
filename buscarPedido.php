<?php
require 'db.php'; // Conexión a la base de datos

// Asegurarse de que el ID se pasa correctamente
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta SQL para buscar el pedido por su ID
    $sql = "SELECT id_pedido, estado, id_cliente, id_vendedor, id_pago, metodo_pago FROM pedido WHERE id_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Vincula el parámetro con el tipo de dato (i = entero)
    $stmt->execute();
    $result = $stmt->get_result();
    
    $pedido = $result->fetch_assoc();
    
    if ($pedido) {
        echo json_encode($pedido); // Devuelve el pedido como JSON
    } else {
        echo json_encode(null); // Si no se encuentra el pedido, retorna null
    }
    
    $stmt->close();
}

$conn->close();
?>
