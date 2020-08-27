<?php
require_once "pdo.php";

if (!isset($_REQUEST['id_atendimento'])) {
  $_SESSION['error'] = "Sem id de atendimento!";
  header("Location: front.php");
  return;
}

$stmt = $pdo->prepare("SELECT * FROM Atendimento where id_atendimento = :ida");
$stmt->execute(array(":ida" => $_REQUEST['id_atendimento']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


if (
  isset($_POST['tipo_entrada']) && isset($_POST['data_internacao']) && isset($_POST['data_saida'])
  && isset($_POST['descricao']) && isset($_POST['diagnostico']) && isset($_POST['cpf_paciente'])
) {
  $stmt = $pdo->prepare('UPDATE Atendimento SET tipo_entrada = :te, tipo_entrada = :te, data_internacao = :di, data_saida = :ds, descricao = :de, diagnostico = :de,
  cpf_paciente = :cpf
      WHERE id_atendimento = :ida');
  $stmt->execute(array(
    ':ida' => $_REQUEST['id_atendimento'],
    ':te' => $_POST['tipo_entrada'],
    ':di' => $_POST['data_internacao'],
    ':ds' => $_POST['data_saida'],
    ':de' => $_POST['descricao'],
    ':dia' => $_POST['diagnostico'],
    ':cpf' => $_POST['cpf_paciente']
  ));
  header('Location: front.php');
}

$tipo_entrada = htmlentities($row['tipo_entrada']);
$data_internacao = htmlentities($row['data_internacao']);
$data_saida = htmlentities($row['data_saida']);
$descricao = htmlentities($row['descricao']);
$diagnostico = htmlentities($row['diagnostico']);
$cpf = htmlentities($row['cpf_paciente']);
$id_atendimento = htmlentities($row['id_atendimento']);

?>

<!DOCTYPE html>
<html>

<head>
  <title>
    Edição da tabela
  </title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script type="text/javascript" src="ojs.js"></script>
</head>

<body>
  <div id="centraliza">
    <h1>EDIÇÃO</h1>
    <form name="formulario" method="POST" action="edita.php" id="formulario">
      <input type="hidden" name="id_atendimento" value="<?= $id_atendimento ?>" />
      <label for="entrada">Tipo de entrada:</label>
      <input type="text" id="entrada" class="inputs" name="tipo_entrada" placeholder="XX" maxlength="2" required value="<?= htmlentities($tipo_entrada) ?>" /><br /><br />
      <label for="dataInternacao">Data de internação:</label>
      <input type="date" id="dataInternacao" class="inputs dataList" name="data_internacao" value="<?= htmlentities($data_internacao) ?>" /><br /><br />
      <label for="dataSaida">Data de saida:</label>
      <input type="date" id="dataSaida" class="inputs dataList" name="data_saida" value="<?= htmlentities($data_saida) ?>" /><br /><br />
      <label for="descricao">Descrição:</label>
      <textarea rows="4" cols="50" class="inputs" name="descricao"><?= htmlentities($descricao) ?></textarea><br /><br />
      <label for="diagnostico">Diagnostico:</label>
      <input type="text" id="diagnostico" class="inputs" name="diagnostico" value="<?= htmlentities($diagnostico) ?>" /><br /><br />
      <label for="cpf">CPF do Paciente:</label>
      <input type="text" id="paciente" class="inputs" name="cpf_paciente" placeholder="111.111.111-11" maxlength="14" required value="<?= htmlentities($cpf) ?>" /><br /><br />
      <input type="submit" id="enviar" class="botaoElipsado" value="Salvar" />
      <a href="front.php"><input type="button" class="botaoElipsado" value="Voltar" /></a>
      <div id="erros"></div>
    </form>
  </div>
  <footer id="rodape">
    <p>
      Made by Adriano, Eric, Ghabriell and Miguel
    </p>
  </footer>
</body>

</html>
