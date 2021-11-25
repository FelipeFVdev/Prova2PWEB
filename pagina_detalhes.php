<?php 
session_start();

if($_GET["codigo"]){
    $id = session_id();
    $produto = $_GET["codigo"];
    $sql = "select * from produto where codigo = $produto";
    $con = new mysqli("localhost", "root","", "ipizza");
    $retorno = mysqli_query($con,$sql);
    $reg = mysqli_fetch_array($retorno);
    mysqli_close($con);
}

if(isset($_GET["inserir"])) inserir();

 function inserir(){
  session_start();
  $_SESSION["codigo"] = $_GET["codigo"];
  $_SESSION["quantidade"] = $_POST["quantidade"]; 
  header("location: incluirCesta.php");
 }
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
            // echo "<a href='#'>Saiba Mais</a>";
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
        <link rel="stylesheet" href="CSS/detalhes.css">
        <title> Detalhes do Produto </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>

    </head>
    <body>
      <div class="topo">            
        <nav class="navbar navbar-light m-3" style="background-color: #1a6f3a;">                
            <div class="container-fluid" id="topoConteainer">
                <a href="principal.php"><img src="pizza/logotrab.png" id="logo" /></a>
              <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn" type="submit" id="btnBuscar" name="btnBuscar">
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

      <div class="container_imagem row" style="margin-left: 4%; margin-top: 1%;">
        <img src="pizza/<?=$reg['codigo'];?>.jpg" style="border-radius: 40px"></img>      
      </div>
      <div class="container_descricao" style="color: white; font-size: 20px; margin-top: 0%; width: 40%">
        <h2 style="color: #98112e"><?php echo $reg['titulo']; ?></h2>
        <h4>R$<?= $reg['valor'];?></h4> 
        <br>
        <p><?= $reg['descritivo'];?> </p>
        <form method="post" action="pagina_detalhes.php?codigo=<?php echo "$produto";?>&inserir=1" style="display: flex;">
        <label style="margin-right: 1.5%; font-size: 24px;"><b>Quantidade:</b></label>
        <input type="number" id="qtd" name="quantidade" style="margin-right: 2%; width: 10%; border-radius: 20%;
         border: 2px solid #27a657" value="1" > 
            <button class="btn btn-outline-success" type="submit" name="btn_comprar"><b>Adicionar ao carrinho</b></button>
        </form>
      </div>
    </body>
</html>

<script lang='javascript'>
    function redirecionaLogin(){
        window.location.href='pagina_login.php';
    }
</script>