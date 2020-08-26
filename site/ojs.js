function ouvido() {
  try {
    document.getElementById("paciente").addEventListener("input", maskCpf);
  } catch {
    console.log("Não há formulario aqui");
  }

  //  console.log("ouvido");
}
document.addEventListener("DOMContentLoaded", ouvido, false);

function maskCpf() {
  //  console.log("ouviu");
  let elCpf = document.getElementById("paciente");

  var valCpf = elCpf.value;
  var saiCpf = valCpf;
  saiCpf = saiCpf.replace(/\D/g, ""); //Remove tudo o que não é dígito
  saiCpf = saiCpf.replace(/(\d{3})(\d)/, "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
  saiCpf = saiCpf.replace(/(\d{3})(\d)/, "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
  //de novo (para o segundo bloco de números)
  saiCpf = saiCpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos

  //  console.log("saiCpf: " + saiCpf + " | valCpf " + valCpf);

  elCpf.value = saiCpf;
}

function validaPrimeiro() {
  document.forms["formulario"]["entrada"].addEventListener("blur", valida);
  document.forms["formulario"]["dataInternacao"].addEventListener(
    "blur",
    valida
  );
  document.forms["formulario"]["descricao"].addEventListener("blur", valida);
  document.forms["formulario"]["diagnostico"].addEventListener("blur", valida);
  document.forms["formulario"]["paciente"].addEventListener("blur", valida);

  return valida();
}

function valida() {
  let erros = "<img id='info' src='SVG/alert-exclamation.svg' /> <br/>";

  document.getElementById("erros").innerHTML = "";
  let houveErro = false;
  let qtdErros = 0;

  let entrada = document.forms["formulario"]["entrada"].value;
  let dataInter = document.forms["formulario"]["dataInternacao"].value;
  let descricao = document.forms["formulario"]["descricao"].value;
  let diagnostico = document.forms["formulario"]["diagnostico"].value;
  let cpf = document.forms["formulario"]["paciente"].value;
  cpf = cpf.replace(/[.|-]/g, "");

  // tipo de entrada
  if (entrada.length > 2) {
    houveErro = true;
    qtdErros++;
    erros =
      erros +
      qtdErros +
      "- Tipo de entrada deve ter no MAXIMO 2 caracteres <br/>";
  }
  if (entrada.length == 0) {
    houveErro = true;
    qtdErros++;
    erros = erros + qtdErros + "- Tipo de entrada não pode ser nulo <br/>";
  }

  //data internacao - não precisam

  // descricao
  if (descricao.length > 500) {
    houveErro = true;
    qtdErros++;
    erros =
      erros + qtdErros + "- Descricao deve ter no MAXIMO 500 caracteres <br/>";
  }
  // diagnostico
  if (diagnostico.length > 45) {
    houveErro = true;
    qtdErros++;
    erros =
      erros + qtdErros + "- Diagnostico deve ter no MAXIMO 45 caracteres <br/>";
  }
  if (diagnostico.length == 0) {
    houveErro = true;
    qtdErros++;
    erros = erros + qtdErros + "- Diagnostico não pode ser nulo <br/>";
  }
  // cpf paciente
  if (cpf.length != 11) {
    houveErro = true;
    qtdErros++;
    erros = erros + qtdErros + "- CPF deve ter 11 digitos <br/>";
  } else {
    let str_cpf = cpf;
    let digito1 = 11;
    let digito2 = 11;
    let soma10 = 0;
    let soma11 = 0;

    for (let i = 0; i < 9; i++) {
      soma10 = soma10 + parseInt(str_cpf[i]) * (10 - i);
      soma11 = soma11 + parseInt(str_cpf[i]) * (11 - i);
      console.log(
        "parseInt(str_cpf[i]) * (11 - i): " +
          parseInt(str_cpf[i]) * (11 - i) +
          " | " +
          "soma11: " +
          soma11
      );
    }
    console.log("soma10: " + soma10 + " | " + "soma11: " + soma11);
    //descobrindo valor do digito 1
    let resto10 = soma10 % 11;
    if (resto10 < 2) {
      digito1 = 0;
    } else {
      digito1 = 11 - resto10;
    }
    soma11 = soma11 + digito1 * 2;
    //descobrindo valor do digito 2
    let resto11 = soma11 % 11;
    if (resto11 < 2) {
      digito1 = 0;
    } else {
      digito2 = 11 - resto11;
    }
    console.log(
      str_cpf[9] + " " + digito1 + " | " + str_cpf[10] + " " + digito2
    );
    console.log("soma10: " + soma10 + " | " + "soma11: " + soma11);

    if (str_cpf[9] != digito1 || str_cpf[10] != digito2) {
      houveErro = true;
      qtdErros++;
      erros = erros + qtdErros + "- CPF invalido <br/>";
    }
  }

  if (houveErro) {
    document.getElementById("erros").innerHTML = erros;
    return false;
  }
  console.log(erros);
  return true;
}

function deleta() {
  document.getElementById("popUpBack").style.display = "flex";
}
function fechar() {
  document.getElementById("popUpBack").style.display = "none";
}
