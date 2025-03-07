<?php
session_start();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Produtos</title>
    <link rel='stylesheet' href='estilo.css'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM' crossorigin='anonymous'>
</head>

<body>

    <!-- Nav no topo da tela -->
    <div class='navbar'>
        <a href='index.php' class='active'>Produto</a>
        <a href='ver_pedidos.php' target='_blank'>Pedidos</a>
        <a href='#'>Perfil</a>
        <a href='login.html'>Sair</a>
    </div>

    <div class="container">

        <section>
            <div>
                <center>
                    <?php
        
        if ( isset( $_GET[ 'message' ] ) ) {
           
        echo '<div class="alert alert-success" role="alert">' . htmlspecialchars( $_GET[ 'message' ] ) . '</div>';
        }
      
    if (isset($_POST['mais_pedidos'])) {
        
        if ($_POST['mais_pedidos'] == 'sim') {
            
            header("Location: index.php");
            exit; 
        }
       
        elseif ($_POST['mais_pedidos'] == 'nao') {
           
            header("Location: finalizar_pedido.php");
            exit; 
        }
    }
        ?>
                </center>
            </div>
        </section>

        <!-- Cards com imagens -->
        <section id='cards'>



            <form action='adicionar_pedido.php' method='POST'>

                <!-- Açaí Puro -->
                <div class='card' style='width: 18rem;'>
                    <img src='../img/acaipuro' class='card-img-top' alt='Fruta Morango'>
                    <div class='card-body'>
                        <h5 class='card-title'>Açaí Puro</h5>
                        <p class='card-text'>Valor: R$15, 00</p>
                        <input type='hidden' name='item' value='Açaí Puro'>
                        <input type='hidden' name='price' value='15'>
                        <label><input type='checkbox' name='options[]' value='Leite Condensado'> Leite
                            Condensado</label>
                        <label><input type='checkbox' name='options[]' value='Paçoca'> Paçoca</label>
                        <label><input type='checkbox' name='options[]' value='Morango'> Morango</label>
                        <label><input type='checkbox' name='options[]' value='Banana'> Banana</label><br>
                        <button type='submit'>Adicionar</button>
                    </div>
                </div>
            </form>

            <form action='adicionar_pedido.php' method='POST'>

                <!-- Açaí Barca -->
                <div class='card' style='width: 18rem;'>
                    <img src='../img/acaibarca' class='card-img-top' alt='Fruta Morango'>
                    <div class='card-body'>
                        <h5 class='card-title'>Açaí Barca</h5>
                        <p class='card-text'>Valor: R$25, 00</p>
                        <input type='hidden' name='item' value='Açaí Barca'>
                        <input type='hidden' name='price' value='25'>
                        <label><input type='checkbox' name='options[]' value='Leite Condensado'> Leite
                            Condensado</label>
                        <label><input type='checkbox' name='options[]' value='Paçoca'> Paçoca</label>
                        <label><input type='checkbox' name='options[]' value='Morango'> Morango</label>
                        <label><input type='checkbox' name='options[]' value='Banana'> Banana</label><br>
                        <button type='submit'>Adicionar</button>
                    </div>
                </div>
            </form>

            <form action='adicionar_pedido.php' method='POST'>
                <!-- Açaí com Cupuaçu -->
                <div class='card' style='width: 18rem;'>
                    <img src='../img/acaicupuacu' class='card-img-top' alt='Fruta Morango'>
                    <div class='card-body'>
                        <h5 class='card-title'>Açaí com Cupuaçu</h5>
                        <p class='card-text'>Valor: R$17, 00</p>
                        <input type='hidden' name='item' value='Açaí com Cupuaçu'>
                        <input type='hidden' name='price' value='17'>
                        <label><input type='checkbox' name='options[]' value='Leite Condensado'> Leite
                            Condensado</label>
                        <label><input type='checkbox' name='options[]' value='Paçoca'> Paçoca</label>
                        <label><input type='checkbox' name='options[]' value='Morango'> Morango</label>
                        <label><input type='checkbox' name='options[]' value='Banana'> Banana</label><br>
                        <button type='submit'>Adicionar</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- <form action='finalizar_pedido.php' method='POST'>
        <button type='submit'>Finalizar Pedido</button>
    </form> -->
       <center><form class="pergunta" action="" method="post">
            <p><h2>Você deseja fazer mais pedidos?</h2></p>
            <button type="submit" name="mais_pedidos" value="sim" class="botao">Sim</button>
            <button type="submit" name="mais_pedidos" value="nao" class="botao">Não</button>
        </form></center>
       
    </div>
</body>

</html>
