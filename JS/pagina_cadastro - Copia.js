function validaCPF(cpf){
  console.log('funcao validacpf')
  if (typeof cpf !== "string") return false
    cpf = cpf.replace(/[\s.-]*/igm, '')
    if (
        !cpf ||
        cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999" 
    ) {
        return false
    }
    var soma = 0
    var resto
    for (var i = 1; i <= 9; i++) 
        soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11))  resto = 0
    if (resto != parseInt(cpf.substring(9, 10)) ) return false
    soma = 0
    for (var i = 1; i <= 10; i++) 
        soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11))  resto = 0
    if (resto != parseInt(cpf.substring(10, 11) ) ) return false
    return true
}

function validaEmail(field) {
  usuario = field.value.substring(0, field.value.indexOf("@"));
  dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
  
  if ((usuario.length >=1) &&
      (dominio.length >=3) &&
      (usuario.search("@")==-1) &&
      (dominio.search("@")==-1) &&
      (usuario.search(" ")==-1) &&
      (dominio.search(" ")==-1) &&
      (dominio.search(".")!=-1) &&
      (dominio.indexOf(".") >=1)&&
      (dominio.lastIndexOf(".") < dominio.length - 1)) {
    return true;
  }
  else{
    return false;
  }
}

function validar(){
  if(txtNome.value == '' || txtNome.value.length < 3){
    alert("Preencha com seu nome!");
    txtNome.value = '';
    txtNome.focus();
    return false;
  }
  if(txtSobrenome.value == '' || txtSobrenome.value.length < 3){
    alert("Preencha com seu sobrenome!");
    txtSobrenome.value = '';
    txtSobrenome.focus();
    return false;
  }
  if(txtCPF.value ==  '' || validaCPF(txtCPF.value) == false){
    alert("Preencha com um CPF v??lido!\nFormato: xxx.xxx.xxx-xx");
    txtCPF.value = '';
    txtCPF.focus();
    return false;
  }
  if(txtEmail.value ==  '' 
  || txtEmail.value.length<6 
  || txtEmail.value.indexOf("@")<=0
  || txtEmail.value.lastIndexOf(".") <= txtEmail.value.indexOf("@")){
    alert("Informe um e-mail v??lido!");
    txtEmail.focus();
    txtEmail.value = "";
    return false;
  }
  if(txtSenha.value == '' || txtSenha.value.length<8 || isNaN(txtSenha.value)){
    alert("Preencha uma senha alfanum??rica com ao menos 8 caracteres!");
    txtSenha.focus();
    txtSenha.value = "";
    return false;
  }
  if(txtSenha.value != txtConfirSenha.value){
    alert("Senha e confirma????o s??o diferentes!");
    txtConfirSenha.focus();
    txtConfirSenha.value = "";
    return false;
  }
  if(txtEndereco == '' || txtEndereco.value.length<5){
    alert("Preencha com seu endere??o!");
    txtEndereco.focus();
    txtEndereco.value = "";
    return false;
  }
  if(nrCasa.value == '' || isNaN(nrCasa.value)){
    alert("Preencha com o n??mero da casa/pr??dio!");
    nrCasa.focus();
    nrCasa.value = "";
    return false;
  }
  if(txtCidade == '' || txtCidade.value.length<5){
    alert("Preencha com a cidade!");
    txtCidade.focus();
    txtCidade.value = "";
    return false;
  }
  if(inputEstado.value == 'EE'){
    alert("Selecione um Estado!");
    inputEstado.focus();
    return false;
  }
  if(nrTelefone.value == ''
  || nrTelefone.value.length < 11){
    alert("Preencha com um n??mero de celular v??lido!");
    nrTelefone.focus();
    nrTelefone.value = "";
    return false;
  }
  formCadastro.submit();
}