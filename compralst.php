<html>
<head>
    <title>Relatório de Compras</title>
    <?php include('config.php'); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <form action="compralst.php" method="post" name="compra">
        <table width="95%" border="1" align="center">
            <tr>
                <td colspan="5" align="center">Relatório de Compras</td>
            </tr>
            <tr>
                <td width="9%" align="right">Nome Cliente:</td>
                <td width="30%"><input type="text" name="nome_cliente" value="<?php echo isset($_POST['nome_cliente']) ? htmlspecialchars($_POST['nome_cliente']) : ''; ?>" /></td>
                <td width="12%" align="right">Nome Produto:</td>
                <td width="26%"><input type="text" name="nome_produto" value="<?php echo isset($_POST['nome_produto']) ? htmlspecialchars($_POST['nome_produto']) : ''; ?>" /></td>
                <td width="21%"><input type="submit" name="botao" value="Gerar" /></td>
            </tr>
        </table>
    </form>

    <?php if (isset($_POST['botao']) && $_POST['botao'] == "Gerar") { ?>
        <table width="95%" border="1" align="center">
            <tr bgcolor="#9999FF">
                <th width="20%">Nome do Cliente</th>
                <th width="25%">Nome do Produto</th>
                <th width="25%">Quantidade</th>
                <th width="25%">Valor Total</th>
                <th width="25%">Valor Unitário</th>
            </tr>
            <?php
            $nome_cliente = isset($_POST['nome_cliente']) ? trim($_POST['nome_cliente']) : '';
            $nome_produto = isset($_POST['nome_produto']) ? trim($_POST['nome_produto']) : '';

            $query = "SELECT cl.nome_cliente, p.nome_produto, cp.qtd_venda, p.valor, FORMAT(cp.qtd_venda * p.valor, 2) as valor_total
                      FROM cliente cl
                      INNER JOIN compra cp ON cp.cod_cliente = cl.cod_cliente
                      INNER JOIN produto p ON p.cod_produto = cp.cod_produto
                      WHERE 1=1";

            if (!empty($nome_cliente)) {
                $query .= " AND cl.nome_cliente LIKE '%" . mysqli_real_escape_string($mysqli, $nome_cliente) . "%'";
            }

            if (!empty($nome_produto)) {
                $query .= " AND p.nome_produto LIKE '%" . mysqli_real_escape_string($mysqli, $nome_produto) . "%'";
            }

            $query .= " ORDER BY cl.nome_cliente, p.nome_produto";

            $result = mysqli_query($mysqli, $query) or die("Erro na consulta: " . mysqli_error($mysqli));

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome_cliente']); ?></td>
                        <td><?php echo htmlspecialchars($row['nome_produto']); ?></td>
                        <td><?php echo htmlspecialchars($row['qtd_venda']); ?></td>
                        <td>R$ <?php echo htmlspecialchars($row['valor_total']); ?></td>
                        <td>R$ <?php echo htmlspecialchars($row['valor']); ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='4' align='center'>Nenhum registro encontrado</td></tr>";
            }
            
            // Libera o resultado da memória
            mysqli_free_result($result);
            ?>
        </table>
    <?php } ?>
    
    <p align="center"><a href="index.html">Voltar para Home</a></p>
</body>
</html>