function tela(){
    
    sizetest = function(){
    
        var size = {
            width:$(".screen").width(),
            height:$(".screen").height()
        }
        var tela = {
            //width: $("body").width(),
            //height: $("body").height()
            width: self.innerWidth,
            height: self.innerHeight
        }
        
        if(size.width < tela.width && size.height < tela.height){
            $(".screen").css("transform", "translate(-50%,-50%)");
            $(".screen").css("top", "50%");
            $(".screen").css("left", "50%");
        }
        else if(size.width >= tela.width && size.height < tela.height){
            $(".screen").css("transform", "translate(0, -50%)");
            $(".screen").css("top", "50%");
            $(".screen").css("left", "0");
        }
        else if(size.width < tela.width && size.height >= tela.height){
            $(".screen").css("transform", "translate(-50%,0)");
            $(".screen").css("top", "0");
            $(".screen").css("left", "50%");
        }
        else{
            $(".screen").css("transform", "");
            $(".screen").css("top", "0");
            $(".screen").css("left", "0");
        }
    
    }
    
     
    sizetest();
    $(window).resize(function(){
        sizetest();
    });
     

};
