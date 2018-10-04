function gerencia(){

    this.tela = new tela();
    this.perguntas;
    this.selecionado;

    $(document).on("mouseenter",".perg" ,function () {
            $( this ).css("background-color","#ccc");
    });

    $(document).on("mouseleave",".perg" ,function () {
            $( this ).css("background-color","white");
    });

    $(document).on("click",".perg" ,function () {
            $(".perg").css("border-color", "#eee");
            gerencia.selecionado = $(this).attr("data-cod");
            console.log(gerencia.selecionado)
            $( this ).css("border-color","blue");
            $( this ).css("border-width","1px");
    });

    $(document).ready(function(){
        $("#lista_perguntas").empty()
        gerencia.updateList(
            $("#busca_pergunta").val(),
            $("#selecao_tema").val()
        );
    });

    $("#editar_botao").click(function(){
        $("#update").val("edit");
        codPer = gerencia.selecionado;
        $.ajax({
            url: "Scripts/consulta_p3.php",
            type: 'POST',
            data: {
                cod: codPer
            },
            dataType: 'json',
            success: function(ret){
                gerencia.carregatexto(ret);
                $("#botao_cancelar_vea").show();
                $("#botao_ok_vea").css("right", "30%");
                $("#botao_ok_vea").html("SALVAR");
                $("#CRUD_vea").show();
            }
        });

    });

    $("#remover_botao").click(function(){
        codPer = gerencia.selecionado;
        setTimeout(gerencia.atualizaLista, 150);
        $.ajax({
            url: "Scripts/removerperg.php",
            type: 'POST',
            data: {
                cod: codPer
            },
            dataType: 'json'
        });

    });

    this.atualizaLista = function(){
        $("#lista_perguntas").empty();
        gerencia.updateList(
            $("#busca_pergunta").val(),
            $("#selecao_tema").val()
        );
    }

    $("#botao_adicionar_pergunta").click(function(){
        $("#update").val("add");
        gerencia.destravatexto();
        $("#botao_cancelar_vea").show();
        $("#botao_ok_vea").css("right", "30%");
        $("#botao_ok_vea").html("SALVAR");
        $("#CRUD_vea").show();
    });

    $("#add_tema").click(function(){
        $("#modal_categoria").show();
    });
    $("#modal_categoria_cancelar").click(function(){
        $("#modal_categoria").hide();
    });

    $("#botao_cancelar_vea").click(function(){
        $("#CRUD_vea").hide();
        $("#selecao_tema_vea").prop('selectedIndex',0);
        $("#caixa_pergunta").val("");
        $("#caixa_resposta_certa").val("");
        $("#caixa_resposta_errada1").val("");
        $("#caixa_resposta_errada2").val("");
        $("#caixa_resposta_errada3").val("");
    });

    $("#selecao_tema").change(function(){
        $("#lista_perguntas").empty()
        gerencia.updateList(
            $("#busca_pergunta").val(),
            $("#selecao_tema").val()
        );
    });

    $("#busca_pergunta").keyup(function(){
        $("#lista_perguntas").empty()
        gerencia.updateList(
            $("#busca_pergunta").val(),
            $("#selecao_tema").val()
        );
    });

    this.genPergunta = function(codPer){

        $("#main_game_screen").hide();
        $("#question_game_screen").show();

        $.ajax({
            url: "Scripts/consulta_p.php",
            type: 'POST',
            data: {
                cod: codPer
            },
            dataType: 'json',
            success: function(ret){
                game.pergunta.loadPergunta(ret);
            }
        });

    }

    this.travatexto = function(){
        $("#caixa_pergunta").attr("readonly", true);
        $("#caixa_resposta_certa").attr("readonly", true);
        $("#caixa_resposta_errada1").attr("readonly", true);
        $("#caixa_resposta_errada2").attr("readonly", true);
        $("#caixa_resposta_errada3").attr("readonly", true);
        $("#caixa_resposta_certa_longa").attr("readonly", true);
        $("#caixa_resposta_errada1_longa").attr("readonly", true);
        $("#caixa_resposta_errada2_longa").attr("readonly", true);
        $("#caixa_resposta_errada3_longa").attr("readonly", true);
    }

    this.destravatexto = function(){
        $("#caixa_pergunta").attr("readonly", false);
        $("#caixa_resposta_certa").attr("readonly", false);
        $("#caixa_resposta_errada1").attr("readonly", false);
        $("#caixa_resposta_errada2").attr("readonly", false);
        $("#caixa_resposta_errada3").attr("readonly", false);
        $("#caixa_resposta_certa_longa").attr("readonly", false);
        $("#caixa_resposta_errada1_longa").attr("readonly", false);
        $("#caixa_resposta_errada2_longa").attr("readonly", false);
        $("#caixa_resposta_errada3_longa").attr("readonly", false);
    }

    $("#visualizar_botao").click(function(){
        codPer = gerencia.selecionado;
        $("#update").val("view");
        $.ajax({
            url: "Scripts/consulta_p3.php",
            type: 'POST',
            data: {
                cod: codPer
            },
            dataType: 'json',
            success: function(ret){
                gerencia.carregatexto(ret);
                gerencia.travatexto();
                $("#botao_cancelar_vea").hide();
                $("#botao_ok_vea").css("right", "50%");
                $("#botao_ok_vea").html("VOLTAR");
                $("#CRUD_vea").show();
            }
        });
    });

    this.carregatexto = function(ret){
        $("#caixa_pergunta").val(ret["descricao"]);
        $("#cod_box").val(ret["codPerg"]);
        $("#selecao_tema_vea").val(ret["nome"]);
        $("#caixa_resposta_certa").val(ret[0]["resCur"]);
        $("#caixa_resposta_errada1").val(ret[1]["resCur"]);
        $("#caixa_resposta_errada2").val(ret[2]["resCur"]);
        $("#caixa_resposta_errada3").val(ret[3]["resCur"]);
        $("#caixa_resposta_certa_longa").val(ret[0]["resLon"]);
        $("#caixa_resposta_errada1_longa").val(ret[1]["resLon"]);
        $("#caixa_resposta_errada2_longa").val(ret[2]["resLon"]);
        $("#caixa_resposta_errada3_longa").val(ret[3]["resLon"]);
    }

    this.loadPergunta = function(retorno){

        this.pergunta = retorno['descricao'];
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

        //this.appendPergunta();
    }

    this.updateList = function(pergunta, tema){
        $.ajax({
            url: "Scripts/listaPerguntas.php",
            type: 'POST',
            data: {
                perg: pergunta,
                tem: tema
            },
            dataType: 'json',
            success: function(ret){
                this.perguntas = ret;
                for(var i = 0; i < ret.length; i++){
                    $("#lista_perguntas").append("<li class=perg data-cod=" + ret[i]['cod'] + ">" + ret[i]['descricao'] + "</li>");
                }
            }

        });
    }

    $("#botao_resposta_certa_longa").click(function(){
        $("#tela_resposta_certa_longa").show();
    });
    $("#botao_resposta_errada1_longa").click(function(){
        $("#tela_resposta_errada1_longa").show();
    });
    $("#botao_resposta_errada2_longa").click(function(){
        $("#tela_resposta_errada2_longa").show();
    });
    $("#botao_resposta_errada3_longa").click(function(){
        $("#tela_resposta_errada3_longa").show();
    });
    $("#botao_feedback_positivo").click(function(){
        $("#tela_feedback_positivo").show();
    });
    $("#botao_feedback_negativo").click(function(){
        $("#tela_feedback_negativo").show();
    });

    $("#ok_certa_longa").click(function(){
        $("#tela_resposta_certa_longa").hide();
    });
    $("#ok_errada1_longa").click(function(){
        $("#tela_resposta_errada1_longa").hide();
    });
    $("#ok_errada2_longa").click(function(){
        $("#tela_resposta_errada2_longa").hide();
    });
    $("#ok_errada3_longa").click(function(){
        $("#tela_resposta_errada3_longa").hide();
    });
    $("#ok_feedback_positivo").click(function(){
        $("#tela_feedback_positivo").hide();
    });
    $("#ok_feedback_negativo").click(function(){
        $("#tela_feedback_negativo").hide();
    });

    $("#cancelar_certa_longa").click(function(){
        $("#tela_resposta_certa_longa").hide();
        $("#caixa_resposta_certa_longa").val('');
    });
    $("#cancelar_errada1_longa").click(function(){
        $("#tela_resposta_errada1_longa").hide();
        $("#caixa_resposta_errada1_longaa").val('');
    });
    $("#cancelar_errada2_longa").click(function(){
        $("#tela_resposta_errada2_longa").hide();
        $("#caixa_resposta_errada2_longa").val('');
    });
    $("#cancelar_errada3_longa").click(function(){
        $("#tela_resposta_errada3_longa").hide();
        $("#caixa_resposta_errada3_longa").val('');
    });
    $("#cancelar_feedback_positivo").click(function(){
        $("#tela_feedback_positivo").hide();
        $("#caixa_feedback_positivo").val('');
    });
    $("#cancelar_feedback_negativo").click(function(){
        $("#tela_feedback_negativo").hide();
        $("#caixa_feedback_negativo").val('');
    });

}
