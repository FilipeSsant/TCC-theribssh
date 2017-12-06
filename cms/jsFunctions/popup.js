//Abre um Pop Up
function abrirPopUp(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"block"});
    $('#div_foraCadastro').css({"display":"block"});
    $("#div_mostrarImagem").css({"display":"block"});
}

//Fecha o Pop UP
function fecharPopUp(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"none"});
    $('#div_foraCadastro').css({"display":"none"});
    $("#div_mostrarImagem").css({"display":"none"});
}

//Abre o Pop Up Adicionar
function abrirAdicionar(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"block"});
    $('#div_foraAdicionar').css({"display":"block"});
    $('#div_ingredientesRegistrados').css({"display":"block"});
}

//Fecha o Pop UP Adicionar
function fecharAdicionar(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"none"});
    $('#div_foraAdicionar').css({"display":"none"});
    $('#div_ingredientesRegistrados').css({"display":"none"});
}
