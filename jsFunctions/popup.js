//Abre um Pop Up
function abrirPopUp(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"block"});
    //Faz aparecer a div do Login
    $('#div_foraLogin').css({"display":"block"});
}

//Abre um Pop Up Alterar Foto
function abrirPopUpAlterarFoto(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"block"});
    //Faz aparecer a div do Login
    $('#div_foraAlterarFoto').css({"display":"block"});
}

//Fecha o Pop UP Alterar Foto
function fecharPopUpCadastroFoto(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"none"});
    //Faz desaparecer a div do Login
    $('#div_foraAlterarFoto').css({"display":"none"});
}

//Abre o Pop UP Cadastro Reservas
function abrirPopUpCadastroReserva(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"block"});
    //Faz desaparecer a div do Login
    $('#div_foraCadastroReserva').css({"display":"block"});
}

//Fecha o Pop UP Cadastro Reservas
function fecharPopUpCadastroReserva(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"none"});
    //Faz desaparecer a div do Login
    $('#div_foraCadastroReserva').css({"display":"none"});
}

//Abrir Pop Up Enquetes
function abrirPopUpEnquetes(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"block"});
    //Faz aparecer a div do Login
    $('#div_foraEnquete').css({"display":"block"});
}

//Fecha o Pop UP Enquetes
function fecharPopUpEnquetes(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"none"});
    //Faz desaparecer a div do Login
    $('#div_foraEnquete').css({"display":"none"});
}


//Fecha o Pop UP
function fecharPopUp(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"none"});
    //Faz desaparecer a div do Login
    $('#div_foraLogin').css({"display":"none"});
}

//Expande para Cadastro caso o usuário clique em cadastrar
function expandirParaCadastro(){
    //Guarda os dados da caixa de Login da tela de login para a tela de Cadastro
    var txt_login = $("#caixa_login").val();
    //Coloca os dados da caixa de texto do Login para a caixa de texto na tela de cadastro
    $("#caixa_loginCadastro").val(txt_login);
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#div_foraCadastro').css({"display":"block"});
    //Faz desaparecer a div do Login
    $('#div_foraLogin').css({"display":"none"});
}

//Abrir Login do Funcionario
function abrirLoginFuncionario(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#div_foraLoginFuncionario').css({"display":"block"});
}

//Abrir Login do Funcionario
function fecharLoginFuncionario(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#div_foraLoginFuncionario').css({"display":"none"});
}

//Fecha o PopUp de cadastro
function fecharPopUpCadastro(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#div_foraCadastro').css({"display":"none"});
    $('#div_foraLogin').css({"display":"block"});
}

//Fecha os PopUps de Cadastro e de Login e a divTransparente
function fecharPopUps(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#div_foraCadastro').css({"display":"none"});
    $('#div_foraCadastroReserva').css({"display":"none"});
    $('#div_foraLogin').css({"display":"none"});
    $('#div_foraAlterarFoto').css({"display":"none"});
    $('#div_foraLoginFuncionario').css({"display":"none"});
    $('#div_foraEnquete').css({"display":"none"});
    $('#fundo_transparente').css({"display":"none"});
    $('#div_ingredienteProduto').css({"display":"none"});
}

//Abrir Info cardápio
function abrirInfoCard(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#fundo_transparente').css({"display":"block"});
    //Faz aparecer a div de ingredientes
    $('#div_ingredienteProduto').css({"display":"block"});
}
