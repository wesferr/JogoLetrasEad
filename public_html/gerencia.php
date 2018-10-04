<!DOCTYPE html>
<html lang="pt-br">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
        <?php
            session_start();
            if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true) or $_SESSION["cat"] == 1){
    	        header('location:game.php');
            }
            $logado = $_SESSION['login'];
        ?>


        <title>jogoLetrasEAD</title>
        <!-- inclusão dos js -->
        <script type="text/javascript" src="./assets/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="./assets/js/tela.js"></script>
        <script type="text/javascript" src="./assets/js/gerencia.js"></script>
        <!-- inclusão dos css -->
        <link rel="stylesheet" type="text/css" href="./assets/css/screen.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/css/gerencia.css"/>

    </head>

    <body>

        <div class="screen" id="CRUD">
            <a id="volta_game" href="game.php">
                <img src="./assets/img/back.png" id="image_back">
                <p id="text_back">VOLTAR</p>
            </a>
            <a class="title" id="CRUD_texto">GERENCIA DE PERGUNTAS</a>

            <select id="selecao_tema">
                <option value="" selected disabled hidden>Selecione um tema</option>
                <?php include "Scripts/consulta_t2.php"; ?>
            </select>
            <ul id="lista_perguntas"></ul>
            <button id="add_tema">Adicionar um tema</button>
            <input id="busca_pergunta" name="search" placeholder="Digite aqui para buscar uma pergunta" type="text">
            <div id="button_bar">
                <button class="botao_pergunta" id="botao_adicionar_pergunta">ADICIONAR</button>
                <button id="visualizar_botao" class="botao_pergunta">VISUALIZAR</button>
                <button id="editar_botao" class="botao_pergunta">EDITAR</button>
                <button id="remover_botao" class="botao_pergunta">REMOVER</button>
            </div>

        </div>

        <div class="screen" id="CRUD_vea" style="display:none">
            <p class="title" id="CRUD_texto">PERGUNTA</p>
            <p class="text" id="texto_tema_vea">Selecione o tema:</p>
            <p class="title"id="texto_respostas_vea">RESPOSTAS</p>
            <p class="text" id="resposta_certa">CERTA</p>
            <p class="text" id="resposta_errada1">ERRADA</p>
            <p class="text" id="resposta_errada2">ERRADA</p>
            <p class="text" id="resposta_errada3">ERRADA</p>



            <button class="botao_pergunta" id="botao_feedback_positivo">FEEDBACK POSITIVO</button>
            <button class="botao_pergunta" id="botao_feedback_negativo">FEEDBACK NEGATIVO</button>

            <form id="gerencia_form" action="Scripts/updateDB.php" method="post">

                <select id="update" type="checkbox" name="update" style="display: none">
                    <option value="add"></option>
                    <option value="edit"></option>
                    <option value="view"></option>
                </select>
                <input id="cod_box" name="codperg" value="" style="display: none">

                <select class="combobox" id="selecao_tema_vea" name="tema">
                    <option value="" selected disabled hidden>Selecione um tema(obrigatorio)</option>
                    <?php include "Scripts/consulta_t2.php"; ?>
                </select>
                <input id="caixa_pergunta" class="inputbox" name="per" placeholder="Digite aqui a pergunta(obrigatorio)">

                <input id="caixa_resposta_certa" class="inputbox" name="resp1" placeholder="Digite aqui a resposta certa(obrigatorio)"></input>
                <input id="caixa_resposta_errada1" class="inputbox" name="resp2" placeholder="Digite aqui uma das respostas erradas(obrigatorio)">
                <input id="caixa_resposta_errada2" class="inputbox" name="resp3" placeholder="Digite aqui uma das respostas erradas(obrigatorio)">
                <input id="caixa_resposta_errada3" class="inputbox" name="resp4" placeholder="Digite aqui uma das respostas erradas(obrigatorio)">

                <div class="screen" style="display: none" id="tela_resposta_certa_longa">
                    <input id="caixa_resposta_certa_longa" class="inputbox"
                        name="resp1longa" placeholder="Digite aqui a resposta certa longa"></input>
                    <div id="ok_certa_longa" class="botao_pergunta"><p class="botao_ok">SALVAR</p></div>
                    <div id="cancelar_certa_longa" class="botao_pergunta"><p class="botao_ok">CANCELAR</p></div>
                </div>

                <div class="screen" style="display: none" id="tela_resposta_errada1_longa">
                    <input id="caixa_resposta_errada1_longa" class="inputbox"
                        name="resp2longa" placeholder="Digite aqui uma das respostas erradas longas">
                    <div id="ok_errada1_longa" class="botao_pergunta"><p class="botao_ok">SALVAR</p></div>
                    <div id="cancelar_errada1_longa" class="botao_pergunta"><p class="botao_ok">CANCELAR</p></div>
                </div>

                <div class="screen" style="display: none" id="tela_resposta_errada2_longa">
                    <input  id="caixa_resposta_errada2_longa" class="inputbox"
                            name="resp3longa" placeholder="Digite aqui uma das respostas erradas longas">

                    <div id="ok_errada2_longa" class="botao_pergunta"><p class="botao_ok">SALVAR</p></div>
                    <div id="cancelar_errada2_longa" class="botao_pergunta"><p class="botao_ok">CANCELAR</p></div>
                </div>

                <div class="screen" style="display: none" id="tela_resposta_errada3_longa">
                    <input id="caixa_resposta_errada3_longa" class="inputbox"
                        name="resp4longa" placeholder="Digite aqui uma das respostas erradas longas">
                    <div id="ok_errada3_longa" class="botao_pergunta"><p class="botao_ok">SALVAR</p></div>
                    <div id="cancelar_errada3_longa" class="botao_pergunta"><p class="botao_ok">CANCELAR</p></div>
                </div>

                <div class="screen" style="display: none" id="tela_feedback_positivo">
                    <input id="caixa_feedback_positivo" class="inputbox"
                        name="feedbackPositivo" placeholder="Digite aqui um feedback positivo para a pergunta">
                    <div id="ok_feedback_positivo" class="botao_pergunta"><p class="botao_ok">SALVAR</p></div>
                    <div id="cancelar_feedback_positivo" class="botao_pergunta"><p class="botao_ok">CANCELAR</p></div>
                </div>

                <div class="screen" style="display: none" id="tela_feedback_negativo">
                    <input id="caixa_feedback_negativo" class="inputbox"
                        name="feedbackNegativo" placeholder="Digite aqui um feedback negativo para a pergunta">
                    <div id="ok_feedback_negativo" class="botao_pergunta"><p class="botao_ok">SALVAR</p></div>
                    <div id="cancelar_feedback_negativo" class="botao_pergunta"><p class="botao_ok">CANCELAR</p></div>
                </div>

                <button class="botao_pergunta" id="botao_ok_vea" type="submit" form="gerencia_form">SALVAR</button>
            </form>


            <button class="botao_pergunta" id="botao_resposta_certa_longa" title="Adicionar resposta longa">></button>
            <button class="botao_pergunta" id="botao_resposta_errada1_longa" title="Adicionar resposta longa">></button>
            <button class="botao_pergunta" id="botao_resposta_errada2_longa" title="Adicionar resposta longa">></button>
            <button class="botao_pergunta" id="botao_resposta_errada3_longa" title="Adicionar resposta longa">></button>
            <button class="botao_pergunta" id="botao_cancelar_vea">CANCELAR</button>

        </div>

        <div class="screen" id="modal_categoria" style="display: none">

            <p class="text" id="modal_categoria_texto">ADICIONAR TEMA</p>
            <form id="categoria_form" action="Scripts/addcategoria.php" method="post">
                <input class="inputbox" id="modal_categoria_box" placeholder="Digite aqui o nome da categoria" name="cat"></input>
                <button class="botao_pergunta" id="modal_categoria_ok" type="submit" form="categoria_form">SALVAR</button>
            </form>
                <button class="botao_pergunta" id="modal_categoria_cancelar">CANCELAR</button>
        </div>

        <script>
            var gerencia = new gerencia();
        </script>

    </body>
</html>
