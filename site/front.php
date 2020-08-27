<?php
require_once "pdo.php";
$stmt = $pdo->query("SELECT * FROM Atendimento");

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
