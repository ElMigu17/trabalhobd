<?php
require_once "pdo.php";


if (
  isset($_POST['tipo_entrada']) && isset($_POST['data_internacao']) && isset($_POST['data_saida'])
  && isset($_POST['descricao']) && isset($_POST['diagnostico']) && isset($_POST['cpf_paciente'])
) {
  $stmt = $pdo->prepare('INSERT INTO atendimento (tipo_entrada, data_internacao, data_saida, descricao, diagnostico, cpf_paciente)
      VALUES (:te, :di, :ds, :de, :dia, :cpf)');
  $stmt->execute(array(
    ':cpf' => $_POST['cpf_paciente'],
    ':te' => $_POST['tipo_entrada'],
    ':di' => $_POST['data_internacao'],
    ':ds' => $_POST['data_saida'],
    ':de' => $_POST['descricao'],
    ':dia' => $_POST['diagnostico']
  ));
  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="pt-br" encoding="utf-8">

<head>
  <title>
    Adição na tabela
  </title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script type="text/javascript" src="ojs.js"></script>
</head>

<body>
  <div id="centraliza">
    <h1>ADIÇÃO</h1>
    <form method="POST" name="formulario" id="formulario">
      <label for="entrada">Tipo de entrada:</label>
      <input type="text" id="entrada" class="inputs" name="tipo_entrada" placeholder="XX" maxlength="2" required /><br /><br />
      <label for="dataInternacao">Data de internação:</label>
      <input type="date" id="dataInternacao" class="inputs dataList" name="data_internacao" /><br /><br />
      <label for="dataSaida">Data de saida:</label>
      <input type="date" id="dataSaida" class="inputs dataList" name="data_saida" /><br /><br />
      <label for="descricao">Descrição:</label>
      <input type="text" id="descricao" class="inputs" name="descricao" /><br /><br />
      <label for="diagnostico">Diagnostico:</label>
      <input type="text" id="diagnostico" class="inputs" name="diagnostico" /><br /><br />
      <label for="paciente">CPF do Paciente:</label>
      <input type="text" id="paciente" class="inputs" name="cpf_paciente" onkeyup="maskCpf()" placeholder="111.111.111-11" maxlength="14" required /><br /><br />
      <input type="submit" id="enviar" class="botaoElipsado" value="Enviar" />
      <a href="front.php"><input type="button" class="botaoElipsado" value="Voltar"/></a>
      <div id="erros"></div>
    </form>
    <footer id="rodape">
      <p>
        Made by Adriano, Eric, Ghabriell and Miguel
      </p>
    </footer>
  </div>
</body>

</html onload="ouvido();">