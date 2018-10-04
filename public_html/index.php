<!DOCTYPE html>
<html lang="pt-br">
<html>

    <head>

        <?php
            session_start();
            if((isset ($_SESSION['login']) == true) and (isset ($_SESSION['senha']) == true)){
    	        header('location:game.php');
            }
        ?>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
        <title>jogoLetrasEAD</title>
        <!-- inclusão dos js -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script src="assets/js/jquery/jquery.min.js"></script>
        <script src="assets/js/tela.js"></script>
        <!-- inclusão dos css -->
        <link rel="stylesheet" type="text/css" href="assets/css/screen.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/entrada_screen.css"/>

    </head>

    <body>

        <div class="screen" id="entrada_screen">

            <p id="entrada_text">ENTRAR</p>
            <p id="entrada_erro" style="display: none">Usuário ou senha inválidos</p>

            <form id="entrada_form" method="post" action="Scripts/login.php">
                <input type="text" name=login placeholder="Usuario"><br>
                <input type="password" name="senha" placeholder="Senha"><br>
                <button type="submit" class="entradabotao" form="entrada_form">Entrar</button><br>
            </form>

            <a href="./cadastro.php">
                <button class="entradabotao" id="botao_cadastro">Cadastrar</button>
            </a>

            <!--<div id="redes_sociais_botoes">
                <a href="http://facebook.com"><img border="0" src="assets/img/facebook.png" id="facebook_image"/></a>
                <a href="http://google.com"><img border="0" src="assets/img/google-plus.png" id="google_image"/></a>
                <a href="http://moodle.unipampa.edu.br"><img border="0" src="assets/img/moodle.png" id="moodle_image"/></a>
            </div>-->

        </div>

        <script>
            var tela = new tela();
        </script>

    </body>

</html>
