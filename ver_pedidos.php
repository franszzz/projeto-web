<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM pedidos WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: ver_pedidos.php"); 
    exit();
}


$sql = "SELECT id, item, price, options FROM pedidos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Feitos</title>
    <link rel='stylesheet' href='ver_pedidos.css'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM' crossorigin='anonymous'>
</head>
<body>
<div class='navbar'>
        <a href='index.php' class='active'>Voltar</a>
        <a href='login.html'>Sair</a>
    </div>
    <h1>Histórico de Pedidos</h1>
    <div class="tabela">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Preço</th>
                <th>Opções</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["item"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["options"] . "</td>";
                    echo "<td><a class='edit-button' href='editar_pedido.php?edit_id=" . $row["id"] . "'>Editar</a> | <a class='delete-button' href='ver_pedidos.php?delete_id=" . $row["id"] . "' onclick='return confirm(\"Tem certeza que deseja excluir este pedido?\");'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum pedido encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
