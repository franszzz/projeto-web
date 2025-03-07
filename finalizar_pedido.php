<?php
session_start();
if (isset($_SESSION['orders']) && !empty($_SESSION['orders'])) {
    $orders = $_SESSION['orders'];

   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "seu_banco_de_dados";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    foreach ($orders as $order) {
        $item = $order['item'];
        $price = $order['price'];
        $options = implode(", ", $order['options']);

        $stmt = $conn->prepare("INSERT INTO pedidos (item, price, options) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $item, $price, $options);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

   
    unset($_SESSION['orders']);    

   
    header("refresh:0;url=ver_pedidos.php");
    exit();
} else {
    echo "<p>Nenhum pedido encontrado.</p>";
   
    header("refresh:0;url=index.php");
    exit();
}
?>
