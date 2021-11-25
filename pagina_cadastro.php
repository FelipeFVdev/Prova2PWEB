<?php session_start(); ?>
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
                    <button class="btn btn-outline-success" type="submit" id="btnBuscar" name="btnBuscar">
                      <i class="fas fa-search"></i>
                    </button>
                  </form>
                  <?php
                      if(isset($_SESSION["nome"])==false){
                        echo "<button type='button' class='btn' id='btnFazerLogin' style='background-color: #fecc68; color: white;' onclick='redirecionaLogin();'>Logar</button>";
                      }else{                        
                        $nome = $_SESSION["nome"];
                        echo "<div class='dropdown'>";
                        echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false' style='background-color: #fecc68;'>Olá, $nome</button>";
                        echo  "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
                        echo "<li><a class='dropdown-item' href='alterar_cadastro.php'>Meus dados</a></li>";
                        echo "<li><a class='dropdown-item' href='carrinhoCompras.php'>Meu carrinho</a></li>";
                        echo "<li><a class='dropdown-item' href='sair.php'>Sair</a></li>";
                        echo "</ul></div>";
                      }
                    ?>            
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
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php?inicial=1">Página Inicial</a>
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php?categoria=Salgada" name="Salgada">Pizzas Salgadas</a>
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php?categoria=Doce">Pizzas Doces</a>
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php?categoria=Bebida">Bebidas</a>
                    </div>
                  </div>
                </div>
              </nav>
        </div>

        <div id="formulario">
            <form method="post" action="pagina_cadastro.php?salvar=1" id="formCadastro" style="width: 70%; margin: auto;">
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
                  <button type="button" class="btn" id="btnCadastrar" name="btnCadastrar" onclick="validar();">Cadastrar</button>
                </div>
              </div>
            </form>
            <?php
              if(isset($_GET["salvar"])) cadastrar();
            ?>
        </div>
    </body>
</html>
<?php
  function cadastrar(){
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
    $sql    = "insert into cliente(nome, sobrenome, cpf, email, senha, rua, numero, complemento, cidade, estado, celular) values ('$nome', '$sobrenome', '$cpf', '$email', '$senha', '$rua', '$numero', '$complemento', '$cidade', '$estado', '$telefone')";
    mysqli_query($con, $sql);
    echo "<script lang='javascript'>window.location.href='pagina_login.php';</script>";
    mysqli_close($con);
  }
?>

<script lang='javascript'>
    function redirecionaLogin(){
        window.location.href='pagina_login.php';
    }
</script>

<?php
    function buscar(){
        $con = new mysqli("localhost", "root", "", "ipizza");
        if(isset($_POST["btnBuscar"])){
            $busca = $_POST["busca"];
            $sql = "select * from produto where titulo like '%$busca%' or categoria like '%$busca%' order by titulo ";
        } else{
            $sql = "select * from produto order by titulo";            
        }
        $retorno = mysqli_query($con, $sql);
        while($reg = mysqli_fetch_array($retorno)){
            $codigo = $reg["codigo"];
            $titulo = $reg["titulo"];
            echo '<li><figure class="pizza-photo"><a href="pagina_detalhes.php?codigo='.$codigo.'"><img src="./pizza/'.$codigo.'.jpg"></a></figure></li>';
            // echo "<a href='#'>Saiba Mais</a>";
        }
        mysqli_close($con);
    }
?>