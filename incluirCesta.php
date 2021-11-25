<?php
	session_start();
if ($_SESSION["codigo"] != "" && $_SESSION["celular"] != ""){
	$produto	=	$_SESSION["codigo"];
	$celular = $_SESSION["celular"];
	$quantidade = $_SESSION["quantidade"];
	$sql = "select codigo from cliente where celular = $celular";
    $con = new mysqli("localhost", "root","", "ipizza");
    $retorno = mysqli_query($con,$sql);
    $_SESSION["codigoCliente"] = mysqli_fetch_array($retorno);
	$x = $_SESSION["codigoCliente"];
    mysqli_close($con);
	$sql	=	"insert into cesta (codigoCliente, codigoProduto, quantidade) values ('$x[0]','$produto', '$quantidade')";
	$conexao = new mysqli ("localhost","root","","ipizza");
	mysqli_query($conexao, $sql);
	mysqli_close($conexao);
}
	header("location: carrinhoCompras.php");
?>
