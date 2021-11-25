<?php
  session_start(); 
?>

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
            
        }
        mysqli_close($con);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="CSS/pagina_login.css">
        <script lang="javascript" src="JS/pagina_login.js"></script>
        <title> Login </title>
    </head>
    <body>
        <div class="topo">            
            <nav class="navbar navbar-light m-3" style="background-color: #1a6f3a;">                
                <div class="container-fluid" id="topoConteainer">
                  <a href="principal.php"><img src="pizza/logotrab.png" id="logoLogin" /></a>
                  <form method="$_POST" class="d-flex" action="vitrine-busca.php">
                    <input  class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn" type="submit" id="btnBuscar" name="btnBuscar">
                      <i class="fas fa-search"></i> 
                    </button>
                    <?php if(isset($_POST["btnBuscar"])) buscar(); ?>
                  </form>
                    <?php
                      if(isset($_SESSION["nome"])==false){
                        echo "<button type='button' class='btn' id='btnFazerLogin' style='background-color: #fecc68; color: white;
                        ' onclick='redirecionaLogin();'>Logar</button>";
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
                  </div>
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
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php?inicial=1">Página Inicial</a>
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php?categoria=Salgada" name="Salgada">Pizzas Salgadas</a>
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php?categoria=Doce">Pizzas Doces</a>
                      <a class="nav-link active" aria-current="page" href="vitrine-busca.php?categoria=Bebida">Bebidas</a>
                    </div>
                  </div>
                </div>
              </nav>
        </div>

        <div class="container row" id="jaCadastroDiv">
          <p class="display-6" id="jaCadastro">Já tenho cadastro</p>
            <form method="post" action="pagina_login.php?logar=1" class="needs-validation" id="formLogin">
                <div class="form-group" id="divEmail">
                    <label for=txtEmailLogin>E-mail</label>
                    <input type="email" class="form-control" id="txtEmailLogin" name="email" required />
                </div>
                <div class="form-group" id="divSenha">
                    <label for="txtSenhaLogin">Senha</label>
                    <input type="password" class="form-control" id="txtSenhaLogin" name="senha" required />
                </div>
                <div class="form-group" id="divBotaoLogar">
                    <button type="button" class="btn" id="btnLogar" onclick="validaLogin();">Logar</button>
                </div>
            </form>
            <?php
              if(isset($_GET["logar"])) logar();
            ?>
            <a href="esqueci.php" id="esqueciSenha">Esqueci minha senha</a>
          </div>
          <div class="container row" id="naoCadastroDiv">
            <p class="display-6" id="naoCadastro">Ainda não tenho cadastro</p>
            <div class="container row" id="btnCadastroDiv">
              <button type="button" class="btn" id="btnNovoCadastro">
                <a href="pagina_cadastro.php" id="linkBtnCadastro">Cadastrar-se</a>
              </button>
            </div>
          </div>
    </body>
</html>
<?php
  function logar(){
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $con = new mysqli("localhost", "root", "", "ipizza");
    $sql = "select * from cliente where email='$email' and senha='$senha'";
    $retorno = mysqli_query($con, $sql);
    if($reg = mysqli_fetch_array($retorno)){
      $_SESSION["codigo"] = $reg["codigo"];
      $_SESSION["nome"] = $reg["nome"];
      $_SESSION["sobrenome"] = $reg["sobrenome"];
      $_SESSION["cpf"] = $reg["cpf"];
      $_SESSION["email"] = $reg["email"];
      $_SESSION["rua"] = $reg["rua"];
      $_SESSION["numero"] = $reg["numero"];
      $_SESSION["complemento"] = $reg["complemento"];
      $_SESSION["cidade"] = $reg["cidade"];
      $_SESSION["estado"] = $reg["estado"];
      $_SESSION["celular"] = $reg["celular"];
      $id = session_id();
      echo "<script lang='javascript'>window.location.href='vitrine-busca.php?inicial=1';</script>";
    } else {
      echo "<h3>E-mail ou senha inválidos!</h3>";
    }
    mysqli_close($con);    
  }
?>

<script lang='javascript'>
    function redirecionaLogin(){
        window.location.href='pagina_login.php';
    }
</script>