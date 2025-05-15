<html>

<head>
<title>Cadastro de Alunos</title>

<?php include ('config.php');  ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<form action="produto.php" method="post" name="produto">
<table width="200" border="1">
  <tr>
    <td colspan="2">Cadastro de produtos</td>
  </tr>
  <tr>
    <td>Nome do produto:</td>
    <td><input type="text" name="nome_produto" ></td>
  </tr>
  <tr>
    <td>Quantidade em estoque:</td>
    <td><input type="number" name="qtde_estoque" ></td>
  </tr>
  <tr>
    <td>Valor unitário:</td>
    <td><input type="number" name="valor" ></td>
  </tr>
    <td colspan="2" align="right"><input type="submit" value="Gravar" name="botao"></td>
    </tr>	
</table>
</form>

<?php
    if (@$_POST['botao'] == "Gravar")
        {
            $nome_produto = $_POST['nome_produto'];
            $qtde_estoque = $_POST['qtde_estoque'];
            $valor = $_POST['valor'];

            $insere = "INSERT into produto(nome_produto, qtde_estoque, valor)
            VALUES ('$nome_produto', '$qtde_estoque', '$valor')";
            mysqli_query($mysqli, $insere) or die ("Impossivel inserir valores");
        }
?>
<p><a href="../index.html">Voltar para Home</a></p>
</body>
</html>