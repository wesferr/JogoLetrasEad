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
        <link rel="stylesheet" type="text/css" href="./assets/css/main_game_screen.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/css/modal.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/css/pergunta.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/css/menu.css"/>

    </head>

    <body>

        <div class="screen" id="main_game_screen">

            <div id="selecao">
                <img alt="tema anterior" src="./assets/img/up.png" id="up_botao_tema">
                <!--<img alt="tema aleatorio" src="./assets/img/dado.png" id="dado_botao_tema">-->
                <img alt="próximo tema" src="./assets/img/down.png" id="down_botao_tema">
                <div id="cards"></div>
            </div>

            <a id="botao_jogar">
                <img alt="" src="./assets/img/play.png" id="img_botao_jogar">
                <p id="texto_botao_jogar">JOGAR</p>
            </a>

            <a href="#">
                <img alt="" src="./assets/img/sair.png" id="img_botao_sair">
                <p id="texto_botao_sair">SAIR</p>
            </a>

            <!---<a href="#">
                <img alt="" src="./assets/img/moeda.png" id="img_botao_moeda">
                <p id="texto_botao_moeda">000</p>
            </a>

            <a href="#">
                <img alt="" src="./assets/img/loja.png" id="img_botao_loja">
                <p id="texto_botao_loja">LOJA</p>
            </a>--->

            <a id="botao_menu">
                <img alt="" src="./assets/img/conf.png" id="img_botao_conf">
                <p id="texto_botao_conf">MENU</p>
            </a>

            <img alt="jucabyte, apresentador do jogo." src="./assets/img/jucabyte.png" id="jucabyte"></img>
            <p class="text" id="pontos">Pontos: 000</p>

        </div>

        <div style="display:none" class="screen" id="question_game_screen">

            <img alt="jucabyte, apresentador do jogo." id="jucabyte_tela" src="./assets/img/jucabyte.png">

            <div id="area_pergunta">
                <img alt="" id="balao_pergunta" src="./assets/img/balao.png">
                <div id="texto_pergunta"></div>
            </div>

            <div id="botao_resposta1">
                <div id="texto_resposta1"></div>
            </div>

            <div id="botao_resposta2">
                <div id="texto_resposta2"></div>
            </div>

            <div id="botao_resposta3">
                <div id="texto_resposta3"></div>
            </div>

            <div id="botao_resposta4">
                <div id="texto_resposta4"></div>
            </div>

            <!--<button class="botao_menu" id="remove_alternativa_botao">REMOVER ALTERNATIVA</button>-->
            <button class="botao_menu" id="volta_pergunta_botao">VOLTAR AO MENU</button>
            <div id=disable_div style="display: none"></div>

            <div id=modalFeedback style="display: none">
                <div id="modalTitulo"></div>
                <div id="modalTexto"></div>
                <div id="modalBotaoProxima"><a>PROXIMA</a></div>
                <div id="modalBotaoSair"><a>MENU</a></div>
            </div>

        </div>

        <div class="screen" id="error_question_screen" style="display: none">
            <p class="text" id="error_text"> SEM PERGUNTAS NESSE TEMA, POR FAVOR, VOLTE AO MENU E SELECIONE OUTRO OU PEÇA A UM PROFESSOR QUE ADICIONE UMA PERGUNTA NELE E TENTE NOVAMENTE</p>
            <button class="botao_menu" id="error_botao">MENU</button>
        </div>

        <div style="display: none" class="screen" id="menu_game_screen">
            <p id="MENU_texto">MENU</p>
            <!--<button class="botao_menu" id="menu_botao1" href="#">LIGAR/DESLIGAR MUSICA</button>-->
            <button class="botao_menu" id="menu_botao2" href="#">GERENCIAR PERFIL</button>
            <button class="botao_menu" id="menu_botao3" href="#">SAIR DO JOGO</button>
            <button class="botao_menu" id="menu_botao4" href="#">VOLTAR AO JOGO</button>
            <button class="botao_menu" id="menu_botao5" href="#">RANKING GERAL</button>
            <?php
                if($_SESSION["cat"] == 2 || $_SESSION["cat"] == 3){
                    echo("<button class='botao_menu' id='menu_botao6' href='#'>GERENCIAR PERGUNTAS</button>");
                    echo("<button class='botao_menu' id='menu_botao7' href='#'>CADASTRAR</button>");
                }
            ?>
            <a href="sobre.php"><button class="botao_menu" id="menu_botao8">SOBRE</button></a>
        </div>

        <div>

        <script>

            var game = new game();
            <?php include "./Scripts/consulta_t.php"; ?>
            

        </script>

    </body>
</html>
