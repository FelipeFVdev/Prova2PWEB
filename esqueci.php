<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">	
		<title> Esqueci a Senha </title>
		<link rel="stylesheet" href="CSS/esqueci.css" />
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
        <div class="recsenha">
            <br>
            <h1>Recuperar senha</h1>
            <form method="post" action="esqueci.php?enviar=1" id="formEsqueci">
              <input type="text" id="txtEmail" name="email" placeholder="Digite um e-mail válido">
              <br><br>
              <button type="butao" name="btnEsqueci" onclick="validar();">Enviar</button>
              <?php if(isset($_POST["btnEsqueci"])) enviarEmail(); ?>
            </form>
        </div>
</body>
</html>

<script language="javaScript">
function validar(){
  if(txtEmail.value ==  '' 
  || txtEmail.value.length<6 
  || txtEmail.value.indexOf("@")<=0
  || txtEmail.value.lastIndexOf(".") <= txtEmail.value.indexOf("@")){
    alert("Informe um e-mail válido!");
    txtEmail.focus();
    txtEmail.value = "";
    return false;
  }
  formEsqueci.submit();
}
</script>
<?php
  function enviarEmail(){
    $email = $_POST["email"];
    $con = new mysqli("localhost", "root", "", "ipizza");
    $sql = "select nome, senha from cliente where email='$email'";
    $retorno = mysqli_query($con, $sql);
    if($reg = mysqli_fetch_array($retorno)){
      $nome = $reg["nome"];
      $senha = $reg["senha"];
      $assunto = "Recuperação de Senha Ipizza";
      $mensagem = "<h4>Olá, $nome!</h4><br/><h4>Sua senha é: $senha</h4><br/><a href='http://localhost/pwtarde/Prova%20PWEB/pagina_login.php'>Clique aqui para logar</a>";
      $header = "MIME-Version: 1.0\r\n";
      $header .= "Content-Type: text/html; charset=UTF-8\r\n";
      $header .= "from: Contato Ipizza<contato.ipizza@outlook.com>";
  
      $success = mail($email, $assunto, $mensagem, $header);
      if($success){
          echo "Email enviado com sucesso";
      }else{
          echo "Ocorreu um erro!";
      }        
    } else {
        echo "E-mail não cadastrado";
    }
    mysqli_close($con);
  }
?>