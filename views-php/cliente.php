<html>

<head>
<title>Cadastro de Cliente</title>

<?php include ('config.php');  ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<form action="cliente.php" method="post" name="cliente">
<table width="200" border="1">
  <tr>
    <td colspan="2">Cadastro de Clientes</td>
  </tr>
  <tr>
    <td>Nome:</td>
    <td><input type="text" name="nome_cliente" ></td>
  </tr>
    <td colspan="2" align="right"><input type="submit" value="Gravar" name="botao"></td>
    </tr>	
</table>
</form>

<?php
    if (@$_POST['botao'] == "Gravar")
    {
        $nome_cliente = $_POST['nome_cliente'];

        $insere = "INSERT into cliente (nome_cliente) 
        VALUES('$nome_cliente')";
        mysqli_query($mysqli, $insere) or die ("Impossível inserir");
    }
?>

    <p><a href="../index.html">Voltar para Home</a></p>
</body>
</html>