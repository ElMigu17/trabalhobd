<?php
require_once "pdo.php";
if(isset($_GET['p']))
{
	$pagina = $_GET['p'];
}
else
{
	$pagina = 1;
}
$registros_por_pagina = 10;
$offset = ($pagina-1) * $registros_por_pagina;

$stmt = $pdo->query("SELECT COUNT(*) FROM Atendimento");
$result = $stmt->fetchAll();
$total_registros = $result[0][0];
$total_paginas = ceil($total_registros / $registros_por_pagina);

$stmt = $pdo->query("SELECT * FROM Atendimento LIMIT $offset, $registros_por_pagina");

if ( isset($_POST['Deleta']) && isset($_POST['id_atendimento']) ) {
  $sql = "DELETE FROM Atendimento WHERE id_atendimento = :ida";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':ida' => $_POST['id_atendimento']));
  header('Location: front.php') ;
  return;
}

?>

<html>

<head>
  <title>
    Atendimentos
  </title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script type="text/javascript" src="ojs.js"></script>
</head>

<body>
  <div id="centraliza">
    <h1>Atendimentos</h1>
    <table id="tabela">
      <tr>
        <th>ID</th>
        <th id="thentrada">T. de entrada</th>
        <th class="thdata">D. Internação</th>
        <th class="thdata">D. Saida</th>
        <th id="thdescricao">Descricao</th>
        <th>Diagnostico</th>
        <th id="thcpf">CPF do Paciente</th>
        <th>Opções</th>
      </tr>
      <?php
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>";
        echo (htmlentities($row['id_atendimento']));
        echo ("</td><td>");
        echo (htmlentities($row['tipo_entrada']));
        echo ("</td>");
        echo ("</td><td>");
        echo (htmlentities($row['data_internacao']));
        echo ("</td>");
        echo ("</td><td>");
        echo (htmlentities($row['data_saida']));
        echo ("</td>");
        echo ("</td><td>");
        echo (htmlentities($row['descricao']));
        echo ("</td>");
        echo ("</td><td>");
        echo (htmlentities($row['diagnostico']));
        echo ("</td>");
        echo ("</td><td>");
        echo (htmlentities($row['cpf_paciente']));
        echo ("</td>");
        echo ("<td>");
        echo ('<a href="edita.php?id_atendimento=' . $row['id_atendimento'] . '"><button><img src="SVG/pencil-alt.svg"
            /></button></a>');
        echo ('<form method="POST">
                <input type="hidden" name="id_atendimento" value="' . $row['id_atendimento']. '"/>
                  <button type="submit" class="botoes" value="Deleta" " name="Deleta">
                    <img src="SVG/trash.svg" />
                  </button></form>');
        echo ("</td>");
        echo ("</tr>");
      }
      ?>
    </table>
    <a href="adiciona.php" class="botaoElipsado" id="add">Adicionar Atendimento <span id="omais">+</span></a>
	<div id="paginacao">
		<a id="voltar-tudo" class="botaoElipsado"  href="?p=1"><<</a>
		<a class="<?php if($pagina <= 1) { echo 'disabled';} ?> botaoElipsado" href="<?php if($pagina > 1) { echo "?p=".($pagina - 1); } ?>" class="botaoElipsado" id="voltar"><</a>
		<a class="<?php if($pagina >= $total_paginas) { echo 'disabled'; } ?> botaoElipsado" href="<?php if($pagina < $total_paginas) { echo "?p=".($pagina+1); } ?>" class="botaoElipsado" id="proximo">></a>
		<a id="ir-final" class="botaoElipsado" href="<?php echo '?p='.($total_paginas); ?>">>></a>
	</div>
  </div>
  <div>
    <footer id="rodape">
      <p>
        Made by Adriano, Eric, Ghabriell and Miguel
      </p>
    </footer>
  </div>

</body>

</html>
