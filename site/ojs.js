/*function ouvido() {
  document.getElementById("paciente").addEventListener("keyup", maskCpf, false);
  console.log("ouvido");
}
document.addEventListener("DOMContentLoaded", ouvido, false);
console.log("ojs is on");
function maskCpf() {
  console.log("ouviu");
  let elCpf = document.getElementById("paciente");
  var valCpf = elCpf.value;
  let tamCpf = valCpf.length;
  var arreio = "123";
  arreio[0] = "9";
  console.log("valCpf[0]: " + arreio[0]);
  if (tamCpf > 3) {
    console.log("entrou no primeiro if");
    let auxValCpf = new Array();
    auxValCpf.length = tamCpf + 1;

    for (let i = tamCpf - 2; i > 2; i--) {
      auxValCpf[i + 1] = valCpf[i];
      console.log("f: " + auxValCpf[i + 1]);
    }
    auxValCpf[3] = ".";
    console.log("auxValCpf: " + auxValCpf);

    /*   if (tamCpf > 6) {
      for (let i = tamCpf; i > 6; i--) {
        valCpf[i + 1] = valCpf[i];
      }
      valCpf[7] = ".";
      if (tamCpf > 9) {
        for (let i = tamCpf - 1; i > 11; i--) {
          valCpf[i + 1] = valCpf[i];
        }
        valCpf[11] = "-";
      }
    }*/
  }
  console.log(valCpf);
  elCpf.value = valCpf;
} */

function deleta() {
  document.getElementById("popUpBack").style.display = "flex";
}
function fechar() {
  document.getElementById("popUpBack").style.display = "none";
}
function valida() {
  let erros = "<img id='info' src='SVG/alert-exclamation.svg' /> <br/>";
  let houveErro = false;
  let qtdErros = 0;
  // tipo de entrada
  if (document.forms["formulario"]["entrada"].value.length > 2) {
    houveErro = true;
    qtdErros++;
    erros =
      erros +
      qtdErros +
      "- Tipo de entrada deve ter no MAXIMO 2 caracteres <br/>";
  }
  if (document.forms["formulario"]["entrada"].value.length == 0) {
    houveErro = true;
    qtdErros++;
    erros = erros + qtdErros + "- Tipo de entrada não pode ser nulo <br/>";
  }

  //data internacao
  console.log(document.forms["formulario"]["dataInternacao"].value);

  // descricao
  if (document.forms["formulario"]["descricao"].value.length > 500) {
    houveErro = true;
    qtdErros++;
    erros =
      erros + qtdErros + "- Descricao deve ter no MAXIMO 500 caracteres <br/>";
  }
  // diagnostico
  if (document.forms["formulario"]["diagnostico"].value.length > 45) {
    houveErro = true;
    qtdErros++;
    erros =
      erros + qtdErros + "- Diagnostico deve ter no MAXIMO 45 caracteres <br/>";
  }
  if (document.forms["formulario"]["diagnostico"].value.length == 0) {
    houveErro = true;
    qtdErros++;
    erros = erros + qtdErros + "- Diagnostico não pode ser nulo <br/>";
  }
  // cpf paciente
  if (document.forms["formulario"]["paciente"].value.length != 11) {
    houveErro = true;
    qtdErros++;
    erros = erros + qtdErros + "- CPF deve ter 11 digitos <br/>";
  } else {
    let str_cpf = document.forms["formulario"]["paciente"].value;
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
  return true;
}
