<?php 

session_start();

$login = $_POST['login'];
$senha = $_POST['senha'];

$chave = md5("4376757d394d5e6f7941235c294b29257366333a5d472f517e793a7c3b");
$senhacrip = openssl_encrypt($senha, "AES-256-CBC", $chave);
$senhacod = base64_encode($senhacrip);


include "dbconfig.php";
$con = mysqli_connect($db_ip, $db_user , $db_password) or die ("Sem conexão com o servidor: " . mysqli_error($con));
$select = mysqli_select_db($con, $db_name) or die("Sem conexão com o banco de dados: " . mysqli_error($con));

$result = mysqli_query($con, "SELECT * FROM `Usuario` WHERE `usuario` = '$login' AND `senha`= '$senhacod'");
echo mysqli_num_rows ($result);
if(mysqli_num_rows ($result) > 0 ){
    $result = mysqli_fetch_assoc($result);
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senhacod;
    $_SESSION['cat'] = $result["codCat"];
    header('location:../game.php');
}
else{
	unset ($_SESSION['login']);
	unset ($_SESSION['senha']);
	setcookie("login", true);
	header("location:../index.php");
	
}
mysqli_close($con);
?>
