<html>
<head>
    <title>Relatório de estoque</title>
    <?php include('config.php'); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <form action="estoquelst.php" method="post" name="estoque">
        <table width="95%" border="1" align="center">
            <tr>
                <td colspan="5" align="center">Relatório de estoque</td>
            </tr>
            <tr>
                <td width="12%" align="right">Nome Produto:</td>
                <td width="26%"><input type="text" name="nome_produto" value="<?php echo isset($_POST['nome_produto']) ? htmlspecialchars($_POST['nome_produto']) : ''; ?>" /></td>
                <td width="21%"><input type="submit" name="botao" value="Gerar" /></td>
            </tr>
        </table>
    </form>

    <?php if (isset($_POST['botao']) && $_POST['botao'] == "Gerar") { ?>
        <table width="95%" border="1" align="center">
            <tr bgcolor="#9999FF">
                <th width="25%">Nome do Produto</th>
                <th width="25%">Quantidade</th> 
                <th width="25%">Valor Unitário</th> 
            </tr>
            <?php
            $nome_produto = isset($_POST['nome_produto']) ? trim($_POST['nome_produto']) : '';

             $query = "SELECT p.nome_produto, p.qtde_estoque, p.valor
                      FROM produto p";

            if (!empty($nome_produto)) {
                $query .= " AND p.nome_produto LIKE '%" . mysqli_real_escape_string($mysqli, $nome_produto) . "%'";
            }

            $query .= " ORDER BY p.qtde_estoque DESC";

            $result = mysqli_query($mysqli, $query) or die("Erro na consulta: " . mysqli_error($mysqli));

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome_produto']); ?></td>
                        <td><?php echo htmlspecialchars($row['qtde_estoque']); ?></td>
                        <td>R$ <?php echo htmlspecialchars($row['valor']); ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='4' align='center'>Nenhum registro encontrado</td></tr>";
            }
            mysqli_free_result($result);
            ?>
        </table>
    <?php } ?>
    
    <p align="center"><a href="index.html">Voltar para Home</a></p>
</body>
</html>