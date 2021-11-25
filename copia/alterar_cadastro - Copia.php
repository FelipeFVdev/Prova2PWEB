<?php
    session_start();
    if(isset($_SESSION["nome"])==false){
        header("location: pagina_login.php");
    }else{
      $codigo = $_SESSION["codigo"];
      $con    = new mysqli("localhost", "root", "", "ipizza");
      $sql    = "select * from cliente where codigo='$codigo'";
      $retorno = mysqli_query($con, $sql);
      $reg = mysqli_fetch_array($retorno);
      echo "<script lang='javascript'>console.log($codigo);</script>";
      // function mostrarDados(){
        $_SESSION["nome"] = $reg["nome"];
        $sobrenome = $_SESSION["sobrenome"];
        $cpf = $_SESSION["cpf"];
        $email  = $_SESSION["email"];
        $rua = $_SESSION["rua"];
        $numero = $_SESSION["numero"];
        $complemento = $_SESSION["complemento"];
        $cidade = $_SESSION["cidade"];
        $estado = $_SESSION["estado"];
        $telefone = $_SESSION["celular"];
        echo "<script lang='javascript'>";
        echo "txtNome.value = '$nome';";
        echo "txtSobrenome.value = '$sobrenome';";
        echo "txtCpf.value = '$cpf';";
        echo "txtEmail.value = '$email';";
        echo "txtEndereço.value = '$rua';";
        echo "nrCasa.value = '$numero';";
        echo "txtComplemento.value = '$complemento';";
        echo "txtCidade.value = '$cidade';";
        echo "inputEstado.value = '$estado';";
        echo "nrTelefone.value = '$telefone';";
        echo "</script>";
        echo "<script lang='javascript'>console.log($cpf);</script>";
      }
    // }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="CSS/pagina_cadastro.css">
        <title> Cadastro </title>
        <script lang="javascript" src="JS/pagina_cadastro.js"></script>
    </head>
    <body>
        <div class="topo">            
            <nav class="navbar navbar-light m-3" style="background-color: #1a6f3a;">                
                <div class="container-fluid">
                  <a href="principal.php"><img src="pizza/logotrab.png" id="logoCadastro" /></a>
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" id="btnBuscar">
                      <i class="fas fa-search"></i>
                    </button>
                  </form>
                  <div class='icones'>
                    <a href="pagina_login.php">
                      <i class="far fa-user-circle" id="usuario" style="font-size: 48px; color: white;"></i>
                    </a>
                    <a href="carrinhoCompras.php">
                        <i class="fas fa-shopping-cart" style="font-size: 48px; margin-right: 0;"></i>
                    </a>
                </div>               
            </nav>            
        </div>
        
        <div class="menu">
            <nav class="navbar navbar-expand-lg navbar-dark m-3" style="background-color: #98112e;">
                <div class="container-fluid text-xs-center">
                  <a class="navbar-brand" href="#">Menu</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav" id="itensMenu">
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php">Página Inicial</a>
                      <a class="nav-link active" aria-current="page" href="#">Pizzas Salgadas</a>
                      <a class="nav-link active" aria-current="page" href="#">Pizzas Doces</a>
                      <a class="nav-link active" aria-current="page" href="#">Bebidas</a>
                    </div>
                  </div>
                </div>
              </nav>
        </div>

        <div id="formulario">
            <form method="post" action="alterar_cadastro.php?alterar=1" id="formCadastro" style="width: 70%; margin: auto;">
              <div class="form row">
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" id="txtNome" name="nome"/>
                </div>
                <div class="form-group">
                  <label>Sobrenome</label>
                  <input type="text" class="form-control" id="txtSobrenome" name="sobrenome"/>
                </div>
                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" class="form-control" id="txtCPF" name="cpf"/>
                </div>
                <div class="form-group">
                  <label>E-mail</label>
                  <input type="email" class="form-control" id="txtEmail" name="email"/>
                </div>
                <div class="form-group col-md-6">
                    <label>Senha</label>
                    <input type="password" class="form-control" id="txtSenha" name="senha"/>
                </div>
                <div class="form-group col-md-6">
                    <label>Confirme a senha</label>
                    <input type="password" class="form-control" id="txtConfirSenha" name="confirmaSenha"/>
                </div>
                <div class="form-group">
                    <label>Rua</label>
                    <input type="text" class="form-control" id="txtEndereco" name="rua"/>
                </div>
                <div class="form-group col-md-2">
                    <label>Número</label>
                    <input type="text" class="form-control" id="nrCasa" name="numero"/>
                </div>
                <div class="form-group col-md-10">
                    <label>Complemento</label>
                    <input type="text" class="form-control" id="txtComplemento" name="complemento"/>
                </div>
                <div class="form-group col-md-6">
                  <label>Cidade</label>
                  <input type="text" class="form-control" id="txtCidade" name="cidade"/>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEstado">Estado</label>
                  <select id="inputEstado" class="form-select" name="inputEstado">
                    <option value="EE">Escolha o Estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                  </select>
                </div>
                <div class="form-group">
                    <label>Celular</label>
                    <input type="text" class="form-control" id="nrTelefone" name="telefone"/>
                </div>
                <br/>
                <div class="form-group">
                  <button type="button" class="btn" id="btnCadastrar" name="btnCadastrar" onclick="validar();">Alterar Cadastro</button>
                </div>
              </div>
            </form>
            <?php
              if(isset($_GET["alterar"])) alterar();
            ?>
        </div>
    </body>
</html>
<?php
  function alterar(){
    $nome   = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $cpf = $_POST["cpf"];
    $email  = $_POST["email"];
    $senha  = $_POST["senha"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["inputEstado"];
    $telefone = $_POST["telefone"];
    $con    = new mysqli("localhost", "root", "", "ipizza");
    $sql    = "update cliente set nome='$nome', sobrenome='$sobrenome', cpf='$cpf', email='$email', senha='$senha', rua='$rua', numero='$numero', complemento='$complemento', cidade='$cidade', estado='$estado', celular='$telefone')";
    mysqli_query($con, $sql);
    mysqli_close($con);
  }
?>