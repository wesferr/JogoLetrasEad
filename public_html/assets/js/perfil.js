function perfil(){
    var telas = new tela();

    $("#update_perfil").click(function(){

        var login = $("#login_box").val();
        var senha_1 = $("#senha1_box").val();
        var senha_2 = $("#senha2_box").val();
        var nome = $("#nome_box").val();

        $.ajax({
            url: "Scripts/update_usr.php",
            type: 'POST',
            data: {
                login: login,
                senha1: senha_1,
                senha2: senha_2,
                nome: nome
            },
            dataType: 'json',
            success: function(ret){
                console.log(ret);
                if(ret){
                    window.location.href = "perfil.php?falta=true";
                } else {
                    window.location.href = "game.php";
                }
            }

        });
    });

    $("#update_cancelar").click(function(){
        window.location.href = "game.php";
    });
}
