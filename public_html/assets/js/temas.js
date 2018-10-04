function Tema(){
    this.nome;
    this.selecionado = 0;
    this.cod;
    
    this.seleciona = function(){
        this.selecionado = 1;
    }
    this.deseleciona = function(){
        this.selecionado = 0;
    }

}

function temas(){
    
    this.temas = new Array();
    this.selecionado = 0;
    
    this.getTemaSel = function(){
        for(var i = 0; i < this.temas.length; i++){
            if(this.temas[i].selecionado){
                console.log(this.temas[i].cod);
                return this.temas[i].cod;
            }
        }
    }
    
    this.temaappend = function(name, codigo) {
        tema = new Tema();
        tema.nome = name;
        tema.cod = codigo;
        this.temas.push(tema);
    }
    
    this.temasshow = function(){
        $("#cards").empty();
        for(var i = 0; i < this.temas.length; i++){
            $("#cards").append("<div class='card' style='z-index:"+this.temas[i].selecionado+"'><div class='cardtext'>"+this.temas[i].nome+"</div></div>");
        }
        
    }
    
    this.temaseleciona = function(num){
        for(var i = 0; i < this.temas.length; i++){
            if(i == num) this.temas[i].seleciona();
            else this.temas[i].deseleciona();
            this.selecionado = num;
        }
    }
    
    this.buttonUp = function(){
        this.selecionado--;
        if(this.selecionado < 0) this.selecionado = this.temas.length-1;
        this.temaseleciona(this.selecionado);
        this.temasshow();
    }
    
    this.buttonDown = function(){
        this.selecionado++;
        if(this.selecionado >= this.temas.length) this.selecionado = 0;
        this.temaseleciona(this.selecionado);
        this.temasshow();
    
    }
    
    

}
