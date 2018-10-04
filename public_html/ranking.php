<!DOCTYPE html>
<html lang="pt-br">
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
        <?php
            session_start();
            if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
    	        unset($_SESSION['login']);
    	        unset($_SESSION['senha']);
    	        header('location:index.php');
            }
            $logado = $_SESSION['login'];
        ?>


        <title>jogoLetrasEAD</title>
        <!-- inclusão dos js -->
        <script type="text/javascript" src="./assets/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="./assets/js/tela.js"></script>
        <script type="text/javascript" src="./assets/js/temas.js"></script>
        <script type="text/javascript" src="./assets/js/game.js"></script>
        <script type="text/javascript" src="./assets/js/question.js"></script>
        <!-- inclusão dos css -->
        <link rel="stylesheet" type="text/css" href="./assets/css/screen.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/css/ranking.css"/>

    </head>

    <body>

        <div class="screen" id="rank_screen">

            <a id="volta_game" href="game.php">
                <img alt="" src="./assets/img/back.png" id="image_back">
                <p class="text" id="text_back">VOLTAR</p>
            </a>

            <table id="users_list"><? include "Scripts/usr_list.php" ?></table>

            <p class="text" id="rank_text">RANKING GERAL</p>


        </div>

        <script>

            var tela = new tela();

        </script>

    </body>
</html>
