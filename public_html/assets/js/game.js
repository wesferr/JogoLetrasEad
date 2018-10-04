function game(){

    this.tela = new tela();
    this.temas = new temas();
    this.pergunta = new question();

    this.temaappend = function(tema, cod){
        this.temas.temaseleciona(0);
        this.temas.temaappend(tema, cod);
        this.temas.temasshow();
    }

    $(document).ready(function(){
        pontuacao();
    });

    $("#botao_menu").click(function(){
        $("#main_game_screen").hide();
        $("#menu_game_screen").show();
    });

    $("#up_botao_tema").click(function(){
        game.temas.buttonUp();
    });

    $("#down_botao_tema").click(function(){
        game.temas.buttonDown();
    });

    $("#botao_jogar").click(function(){
        game.pergunta.genPergunta(game.temas.getTemaSel());
    });

    $("#botao_resposta1").click(function(){
        game.pergunta.botaoResposta(0);
    });

    $("#botao_resposta2").click(function(){
        game.pergunta.botaoResposta(1);
    });

    $("#botao_resposta3").click(function(){
        game.pergunta.botaoResposta(2);
    });

    $("#botao_resposta4").click(function(){
        game.pergunta.botaoResposta(3);
    });

    $("#img_botao_sair").click(function(){
        window.location.href = "Scripts/logout.php";
    });

    $("#modalBotaoProxima").click(function(){
        game.pergunta.novaPergunta(game.temas.getTemaSel());
    });

    $("#modalBotaoSair").click(function(){
        game.pergunta.voltaMenu();
        pontuacao();
    });

    $("#menu_botao2").click(function(){
        window.location.href='perfil.php';
    });

    $("#menu_botao3").click(function(){
        window.location.href='Scripts/logout.php';
    });

    $("#menu_botao4").click(function(){
        $("#main_game_screen").show();
        $("#menu_game_screen").hide();
    });

    $("#menu_botao5").click(function(){
        window.location.href='ranking.php';
    });

    $("#menu_botao6").click(function(){
        window.location.href='gerencia.php';
    });

    $("#menu_botao7").click(function(){
        window.location.href='cadastro.php';
    });

    $("#remove_alternativa_botao").click(function(){
        game.pergunta.escolheRemoção(game.pergunta.codpergunta);
    });

    function pontuacao(){
        $.ajax({
            url: "Scripts/load_pts.php",
            type: 'POST',
            dataType: 'json',
            success: function(ret){
                $("#pontos").html("Pontos: " + ret);
            }
        });
    }

}
