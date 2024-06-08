<?php
// Conectar ao banco de dados (use suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário de edição foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $item = $_POST['item'];
    $price = $_POST['price'];
    $options = isset($_POST['options']) ? implode(", ", $_POST['options']) : '';

    $update_sql = "UPDATE pedidos SET item = ?, price = ?, options = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sisi", $item, $price, $options, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ver_pedidos.php");
    exit();
}

// Verifica se há um pedido a ser editado
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $select_sql = "SELECT id, item, price, options FROM pedidos WHERE id = ?";
    $stmt = $conn->prepare($select_sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pedido = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link rel='stylesheet' href='editar_pedidos.css'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM' crossorigin='anonymous'>
</head>
<body>
    <div class='navbar'>
        <a href='index.php' class='active'>Voltar</a>
        <a href='login.html'>Sair</a>
    </div>
    <table>
    <thead>
    <h1>Editar Pedido</h1>
    <?php if ($pedido): ?>
    <form action="editar_pedido.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
        <label for="item">Item:</label>
        <input type="text" id="item" name="item" value="<?php echo $pedido['item']; ?>"><br>
        <label for="price">Preço:</label>
        <input type="text" id="price" name="price" value="<?php echo $pedido['price']; ?>"><br>
        <label>Opções:</label><br>
        <label><input type="checkbox" name="options[]" value="Leite Condensado" <?php echo strpos($pedido['options'], 'Leite Condensado') !== false ? 'checked' : ''; ?>> Leite Condensado</label><br>
        <label><input type="checkbox" name="options[]" value="Paçoca" <?php echo strpos($pedido['options'], 'Paçoca') !== false ? 'checked' : ''; ?>> Paçoca</label><br>
        <label><input type="checkbox" name="options[]" value="Morango" <?php echo strpos($pedido['options'], 'Morango') !== false ? 'checked' : ''; ?>> Morango</label><br>
        <label><input type="checkbox" name="options[]" value="Banana" <?php echo strpos($pedido['options'], 'Banana') !== false ? 'checked' : ''; ?>> Banana</label><br>
        <button type="submit">Salvar Alterações</button>
    </thead>
    </form>
    </table>
    <?php else: ?>
    <p>Pedido não encontrado.</p>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
