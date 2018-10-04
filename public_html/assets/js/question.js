function Resposta(){
    this.pergunta;
    this.curta;
    this.longa;
    this.cod;
}

function question(){

    this.pergunta;
    this.resposta = new Array();
    this.feedbackPositivo;
    this.feedbackNegativo;
    this.removidas = 0;

    this.genPergunta = function(codTema){

        $.ajax({
            url: "Scripts/consulta_p.php",
            type: 'POST',
            data: {
                cod: codTema
            },
            dataType: 'json',
            success: function(ret){
                game.pergunta.loadPergunta(ret);
            },
            error: function(){
                game.pergunta.loaderror();
            }
        });

    }

    this.loaderror = function(){
        $("#main_game_screen").hide();
        $("#error_question_screen").show();
    }

    $("#error_botao").click(function(){
        $("#main_game_screen").show();
        $("#error_question_screen").hide();
    });

    $("#volta_pergunta_botao").click(function(){
        $("#question_game_screen").hide();
        $("#main_game_screen").show();
        game.pergunta.limpaPergunta();
    });

    this.loadPergunta = function(retorno){

        this.pergunta = retorno['descricao'];
        this.codpergunta = retorno['codPerg'];
        this.positivo = retorno['feedbackPositivo'];
        this.negativo = retorno['feedbackNegativo'];

        this.resposta[0] = new Resposta();
        this.resposta[0].pergunta = retorno['codPerg'];
        this.resposta[0].curta = retorno[0]['resCur'];
        this.resposta[0].longa = retorno[0]['resLon'];
        this.resposta[0].cod = retorno[0]['codres'];

        this.resposta[1] = new Resposta();
        this.resposta[1].pergunta = retorno['codPerg'];
        this.resposta[1].curta = retorno[1]['resCur'];
        this.resposta[1].longa = retorno[1]['resLon'];
        this.resposta[1].cod = retorno[1]['codres'];

        this.resposta[2] = new Resposta();
        this.resposta[2].pergunta = retorno['codPerg'];
        this.resposta[2].curta = retorno[2]['resCur'];
        this.resposta[2].longa = retorno[2]['resLon'];
        this.resposta[2].cod = retorno[2]['codres'];

        this.resposta[3] = new Resposta();
        this.resposta[3].pergunta = retorno['codPerg'];
        this.resposta[3].curta = retorno[3]['resCur'];
        this.resposta[3].longa = retorno[3]['resLon'];
        this.resposta[3].cod = retorno[3]['codres'];

        this.appendPergunta();

        $("#main_game_screen").hide();
        $("#question_game_screen").show();
    }

    this.appendPergunta = function(){
                $("#texto_pergunta").html(this.pergunta);
                $("#texto_resposta1").html(this.resposta[0].curta);
                $("#botao_resposta1").attr('title', this.resposta[0].longa);
                $("#texto_resposta2").html(this.resposta[1].curta);
                $("#botao_resposta2").attr('title', this.resposta[1].longa);
                $("#texto_resposta3").html(this.resposta[2].curta);
                $("#botao_resposta3").attr('title', this.resposta[2].longa);
                $("#texto_resposta4").html(this.resposta[3].curta);
                $("#botao_resposta4").attr('title', this.resposta[3].longa);
    }


    this.botaoResposta = function(num){
        codResp = this.resposta[num].cod;
        codPerg = this.resposta[num].pergunta;
        $.ajax({
            url: "Scripts/resposta.php",
            type: 'POST',
            data: {
                codResp: codResp,
                codPerg: codPerg
            },
            dataType: 'json',
            success: function(ret){
                game.pergunta.resPergunta(ret, num);
            }
        });
    }

    this.resPergunta = function (ret, num){
        $("#disable_div").show();
        this.buttonsColors(ret, num);
    }

    this.buttonsColors = function(ret, num){

        if(ret.acertou == true){
            $("#botao_resposta" + (num+1)).css("background-color", "green");
            setTimeout(function(){
                game.pergunta.modal(ret);
            }, 1000);
        }else{
            for(i = 0; i < this.resposta.length; i++){
                if(this.resposta[i].cod == ret.certa){
                    $("#botao_resposta" + (i+1)).css("background-color", "green");
                }
                else{
                    $("#botao_resposta" + (i+1)).css("background-color", "white");
                }
            }
            $("#botao_resposta" + (num+1)).css("background-color", "orange");
            setTimeout(function(){
                game.pergunta.modal(ret);
            }, 1000);
        }

    }

    this.modal = function(ret){
        if(ret.acertou){
            this.feedbackPositivo(ret);
        }
        else{
            this.feedbackNegativo(ret);
        }
    }

    this.feedbackPositivo = function(ret){
        $("#modalTitulo").html("Parabéns, Certa Resposta<br>MAIS 20 PONTOS PRA VOCÊ");
        $("#modalTexto").html(this.positivo);
        $("#modalFeedback").show();

    }

    this.feedbackNegativo = function(ret){
        $("#modalTitulo").html("Que Pena, Resposta Errada.");
        $("#modalTexto").html(this.negativo);
        $("#modalFeedback").show();
    }

    this.limpaPergunta = function(){
        $("#disable_div").hide();
        $("#modalFeedback").hide();
        $("#modalTitulo").empty();
        $("#modalTexto").empty();
        $("#texto_pergunta").empty();
        for(i = 0; i < this.resposta.length; i++){
            $("#texto_resposta" + (i+1)).empty();
            $("#botao_resposta" + (i+1)).css("background-color", "white");
            $("#botao_resposta" + (i+1)).show();
        }
        this.pergunta = null;
        this.positivo = null;
        this.negativo = null;
        this.resposta = new Array();
    }

    this.novaPergunta = function(codTema){
        this.limpaPergunta();
        this.genPergunta(codTema);
    }

    this.voltaMenu = function(){

        this.limpaPergunta();
        $("#question_game_screen").hide();
        $("#main_game_screen").show();
    }

    this.escolheRemoção = function(codpergunta){
        $.ajax({

            url: "Scripts/remover.php",
            type: 'POST',
            data: {
                pergunta: codpergunta
            },
            dataType: 'json',
            success: function(ret){
                if(ret.codAlt > 0){
                    for(i = 0; i < game.pergunta.resposta.length; i++){
                        if(game.pergunta.resposta[i].cod == ret.codAlt){
                            console.log(ret.codAlt);
                            $("#botao_resposta" + (i+1)).hide();
                        }
                    }
                }
            }

        });
    }
}
