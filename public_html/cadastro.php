<!DOCTYPE html>
<html lang="pt-br">
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
        <title>jogoLetrasEAD</title>
        <!-- inclusão dos js -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script src="./assets/js/jquery/jquery.min.js"></script>
        <script src="./assets/js/tela.js"></script>
        <script src="./assets/js/cadastro.js"></script>
        <!-- inclusão dos css -->
        <link rel="stylesheet" type="text/css" href="./assets/css/screen.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/css/entrada_screen.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/css/cadastro.css">

    </head>

    <body>

        <div class="screen" id="entrada_screen">

            <p id="cadastro_titulo">CADASTRO</p>
            <p id="cadastro_usuario">USUÁRIO</p>
            <p id="cadastro_senha1">SENHA</p>
            <p id="cadastro_senha2">REPETIR SENHA</p>
            <p id="cadastro_nome">NOME</p>
            <p id="cadastro_categoria">CATEGORIA</p>

            <?php
                if( !empty($_GET["falta"]) ){
                    echo("<p id=falta_text> Algum campo não foi digitado, digite novamente </p>");
                }
            ?>

            <form id="cadastro_form" action="Scripts/cadastrar.php" method="post">
                <input id="caixa_usuario" class="textbox" name="usr" type="text" placeholder="Digite o seu usuário(será usado para entrar no jogo)">
                <input id="caixa_senha1" class="textbox" name="pas1" type="password" placeholder="Digite uma senha para o seu usuario">
                <input id="caixa_senha2" class="textbox" name="pas2" type="password" placeholder="Repita a senha digitada">
                <input id="caixa_nome" class="textbox" name="nome" type="text" placeholder="Digite o seu nome(opcional)">
                <select class='textbox' id='catsell' name=cat>
                    <option value=1 selected>Jogador</option>
                    <? session_start();
                        if( isset($_SESSION["login"]) and isset($_SESSION["senha"]) and isset($_SESSION["cat"]) )
                            if($_SESSION["cat"] == 2 || $_SESSION["cat"] == 3)
                                echo("<option value=2>Professor</option>");
                    ?>
                <select>
                <button class="botao_menu" id="cadastro_ok" type="submit" form="cadastro_form">CADASTRAR</button>
            </form>
            <button class="botao_menu" id="cadastro_cancelar">CANCELAR</button>


        </div>

        <script>
            var cadastro = new cadastro();
        </script>

    </body>

</html>
