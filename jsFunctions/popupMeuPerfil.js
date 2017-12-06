//Abre o Alterar dados
function abrirPopUpAlterar(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#div_foraAlterar').css({"display":"block"});
    $('#fundo_transparente').css({"display":"block"});
}
//Fecha os PopUps de Cadastro e de Login e a divTransparente
function fecharPopUps(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"none"});
    $('#div_foraAlterar').css({"display":"none"});
    $('#div_foraNovaSenha').css({"display":"none"});
}

//Fecha o Pop UP
function fecharPopUpCadastroAlterar(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"none"});
    //Faz desaparecer a div de Alterar
    $('#div_foraAlterar').css({"display":"none"});
}

function abrirPopUpAlterarSenha(){
  //Após o $ é o id ou a classe na qual se deseja implementar uma função css
  //No .css é implementada o comando css dentro do {}
  $('#div_foraNovaSenha').css({"display":"block"});
  $('#fundo_transparente').css({"display":"block"});
}

function fecharPopUpAlterarSenha(){
  //Após o $ é o id ou a classe na qual se deseja implementar uma função css
  //No .css é implementada o comando css dentro do {}
  $('#div_foraNovaSenha').css({"display":"none"});
  $('#fundo_transparente').css({"display":"none"});
}


