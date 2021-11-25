<?php 
session_start();
if(isset($_SESSION["nome"])==false){
  header('location: pagina_login.php');
}

function listarCesta(){
  $codigoCliente = $_SESSION["codigoCliente"];
	$sql 	= "select p.codigo, p.titulo, c.quantidade, p.valor from cesta c, produto 
  p where c.codigoProduto=p.codigo and c.codigoCliente='$codigoCliente[0]' order by p.codigo";
	$conexao 	= 	new mysqli("localhost", "root","","ipizza");
	$retorno 	=	mysqli_query($conexao, $sql);
	while($reg 	=	mysqli_fetch_array($retorno)){
		$codigo		=	$reg["codigo"];
		$titulo		=	$reg["titulo"];
		$valor		=	$reg["valor"];
		$quantidade		=	$reg["quantidade"];
		echo "<tr><td>$codigo</td>";
		echo "<td>$titulo</td>";
		echo "<td>$quantidade</td>";
		echo "<td>$valor</td>";
	}
	mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">	
		<title> Carrinho de compras </title>
		<link rel="stylesheet" href="CSS/carrinhoCompras.css" />
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
	        <h1><b>Carrinho de compras</b></h1>
          <div class="carrinho"> 
            <table class="table" style="background-color: #1a6f3a; color: white; width: 60%; margin-left: 20%; margin-top: 3%;">
              <tr>
                <td>
                  <b>Codigo</b>
                </td>
                <td>
                  <b>Produto</b>
                </td>
                <td>
                  <b>Qtd</b>
                </td>
                <td>
                  <b>Valor</b>
                </td>
              </tr>
              <?php listarCesta(); ?>
            </table>           
          </div>
          <div id="botoes" style="display: flex;">
              <button class="btn btn-outline-success" type="submit" id="btnBuscar" name="btnLimpar"
                style="width: 10%; margin-left: 19.90%; margin-right: 40.2%; "> Limpar </button>
              <button class="btn btn-outline-success" type="submit" id="btnBuscar" 
                style="width: 10%;  "> Comprar </button>  
          </div>
</body>	
</html>

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