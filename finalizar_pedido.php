<?php
session_start();
if (isset($_SESSION['orders']) && !empty($_SESSION['orders'])) {
    $orders = $_SESSION['orders'];

    // Conectar ao banco de dados (use suas credenciais)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "seu_banco_de_dados";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Inserir cada pedido na base de dados
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

    // Limpar os pedidos da sessão
    unset($_SESSION['orders']);    

    // echo "<h1>Pedido Confirmado</h1>";
    // echo "<p>Seu pedido foi registrado com sucesso.</p>";

    // Redirecionar de volta para o index.php após 2 segundos
    header("refresh:0;url=ver_pedidos.php");
    exit();
} else {
    echo "<p>Nenhum pedido encontrado.</p>";
    // Redirecionar de volta para o index.php após 2 segundos
    header("refresh:0;url=index.php");
    exit();
}
?>
