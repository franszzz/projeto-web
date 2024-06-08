<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $options = isset($_POST['options']) ? $_POST['options'] : [];

    $pedido = [
        'item' => $item,
        'price' => $price,
        'options' => $options
    ];

    if (!isset($_SESSION['orders'])) {
        $_SESSION['orders'] = [];
    }

    $_SESSION['orders'][] = $pedido;

    // Passando a mensagem pela URL
    header('Location: index.php?message=Pedido%20adicionado%20com%20sucesso!');
    exit();
}
?>
