<html>

<head>
  <title>Compra produtos</title>
  <?php include('config.php'); ?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
  <form action="compra.php" method="post" name="compra">
    <table width="200" border="1">
      <tr>
        <td colspan="2">Compra de clientes</td>
      </tr>
      <tr>
        <td>Data da compra:</td>
        <td><input type="date" name="data"></td>
      </tr>
      <tr>
        <td>Código cliente:</td>
        <td><input type="text" name="cod_cliente"></td>
      </tr>
      <tr>
        <td>Código produto:</td>
        <td><input type="text" name="cod_produto"></td>
      </tr>
      <tr>
        <td>Quantidade de compra:</td>
        <td><input type="text" name="qtd_venda"></td>
      </tr>
      <tr>
        <td colspan="2" align="right"><input type="submit" value="Gravar" name="botao"></td>
      </tr>
    </table>
  </form>

  <?php
  if (@$_POST['botao'] == "Gravar") {
    $data = $_POST['data'];
    $cod_cliente = $_POST['cod_cliente'];
    $cod_produto = $_POST['cod_produto'];
    $qtd_venda = $_POST['qtd_venda'];
    $select = "SELECT qtde_estoque FROM produto WHERE cod_produto = '$cod_produto' AND qtde_estoque >= $qtd_venda";
    $result = mysqli_query($mysqli, $select) or die("Erro ao verificar estoque");

    if (mysqli_num_rows($result) > 0) {
      // Produto tem estoque suficiente, prossegue com a transação
  
      // Atualiza o estoque do produto (subtrai a quantidade vendida)
      $update = "UPDATE produto SET qtde_estoque = qtde_estoque - $qtd_venda WHERE cod_produto = '$cod_produto'";
      mysqli_query($mysqli, $update) or die("Não foi possível atualizar o estoque");

      // Insere o registro da venda
      $insere = "INSERT INTO compra(data_compra, qtd_venda, cod_cliente, cod_produto) 
                   VALUES ('$data', '$qtd_venda', '$cod_cliente', '$cod_produto')";
      mysqli_query($mysqli, $insere) or die("Não foi possível registrar a venda");

      echo "Venda registrada com sucesso";
    } else {
      die("Estoque insuficiente ou produto não encontrado");
    }
  }
  ?>
  <p><a href="../index.html">Voltar para Home</a></p>

</html>