<?php
// Incluye la conexión a la base de datos
include 'db.php';

// Verifica si el parámetro id_vendedor está presente
if (isset($_GET['id_vendedor'])) {
    $idVendedor = intval($_GET['id_vendedor']);

    // Consulta para obtener los ítems asociados al vendedor
    $sql = "SELECT im.id_itemMenu, im.nombre 
            FROM itemmenu im
            INNER JOIN vendedor_itemmenu vim ON im.id_itemMenu = vim.id_itemMenu
            WHERE vim.id_vendedor = ?";
    
    // Prepara la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idVendedor);
    $stmt->execute();
    $result = $stmt->get_result();

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    // Devuelve los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($items);
} else {
    // Devuelve un error si no se envió el parámetro id_vendedor
    http_response_code(400);
    echo json_encode(["error" => "Parámetro id_vendedor no especificado"]);
}
?>
