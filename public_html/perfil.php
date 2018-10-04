<!DOCTYPE html>
<html lang="pt-br">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
        <?php
            session_start();
            if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
    	        header('location:game.php');
            }
            $logado = $_SESSION['login'];
        ?>
        <title>jogoLetrasEAD</title>
        <!-- inclusão dos js -->
        <script type="text/javascript" src="./assets/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="./assets/js/tela.js"></script>
        <script type="text/javascript" src="./assets/js/perfil.js"></script>
        <!-- inclusão dos css -->
        <link rel="stylesheet" type="text/css" href="./assets/css/screen.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/css/perfil.css"/>

    </head>

    <body>

        <div class="screen">

            <p class="text" id="GDP">GERENCIAMENTO DE PERFIL</p>
            <p class="text" id="login_text">LOGIN</p>
            <p class="text" id="password_text1">SENHA</p>
            <p class="text" id="password_text2">REPETIR A SENHA</p>
            <p class="text" id="nome_text">NOME</p>

            <?php
                if( !empty($_GET["falta"]) ){
                    echo("<p class='text' id=falta_text> Algum campo não foi digitado, digite novamente </p>");
                }
            ?>

            <input class="inputbox" id="login_box" name="login" type="text" placeholder="Digite aqui seu login">
            <input class="inputbox" id="senha1_box" name="senha1" type="password" placeholder="Digite aqui sua senha se deseja altera-la"></input>
            <input class="inputbox" id="senha2_box" name="senha2" type="password" placeholder="Repita aqui a senha de deseja altera-la"></input>
            <input class="inputbox" id="nome_box"name="nome" type="name" placeholder="Digite seu nome">

            <button class="botao_pergunta" id="update_perfil">ATUALIZAR PERFIL</button>
            <button class="botao_pergunta" id="update_cancelar">CANCELAR</button>
            <script>
            <?php
                include "Scripts/load_usr.php";
            ?>
            </script>

        </div>

        <script>
            var perfil = new perfil();
        </script>
    </body>
</html>
