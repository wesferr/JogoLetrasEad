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
        <style>
            #error_text{
                position: absolute;
                top: 40%;
                left: 50%;
                width: 75%;
                text-align: center;

            }
            #error_botao{
                position: absolute;
                top: 60%;
                left: 50%;
            }
        </style>
        <!-- inclusão dos css -->
        <link rel="stylesheet" type="text/css" href="./assets/css/screen.css"/>

    </head>

    <body>

        <div class="screen" id="entrada_screen">

            <p class="text" id="error_text">ALGUM DOS CAMPOS OBRIGATORIOS NÃO FOI PREENCHIDO, POR FAVOR, PREENCHA O CAMPO PERGUNTA, OS CAMPOS DE RESPOSTA CURTA E SELECIONE O TEMA</p>
            <button class="botao_menu" id="error_botao" onclick="window.location.href='gerencia.php'">VOLTAR</button>

        </div>

        <script>
            var tela = new tela();
        </script>

    </body>

</html>
