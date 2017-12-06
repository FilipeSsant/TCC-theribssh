<!--Div de Login-->
<div id="div_foraLogin" style="background-color:<?php echo($corPrimaria); ?>;">
    <!--Botão fechar-->
    <div class="botao_fecharPopUp" onClick="fecharPopUp()" style="background-color:<?php echo($corQuartenaria); ?>;">
        <img src="../img/fecharPopUp.png" alt="">
    </div>
    <!--Div de Login-->
    <div class="div_login">
        <!--Título div Login ou Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo" style="background-color:<?php echo($corQuartenaria); ?>;">
            </div>
            <!--Texto do Título-->
            <div class="divTexto_loginCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
                <span style="color:<?php echo($corSecundaria); ?>;">Conecte-se</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div class="formulario_login">
            <form method="post" action="#">
                <input class="input_texto" type="text" name="txt_login" placeholder="Digite seu login ou e-mail"><br>
                <input class="input_texto" type="password" name="txt_senha" placeholder="Digite sua senha"><br>
                <!--Imagem para ao clique revelar a senha
                    No qual o onmousedown serve para no clique revelar e onmouseup ao soltar do clique
                    a senha voltar ao formato password
                -->
                <div class="ver_senha" onmousedown="textSenha()" onmouseup="passwordSenha()">
                    <img src="../img/revelarSenha.png" alt="">
                </div>
                <!--Botão Login-->
                <button class="botao_formulario" type="submit" name="botaoLogin" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;">Entrar</span>
                </button>
                <!--Botão Cadastrar-->
                <button class="botao_formulario" type="button" onClick="expandirParaCadastro()" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;">Cadastrar</span>
                </button>
            </form>
            <!--Botão para cadastrar como funcionario-->
            <div id="div_botao_cadastrarComoFuncionario" onclick="abrirLoginFuncionario()" onmouseover="aparecerMensagemLoginFuncionario()" onmouseout="desaparecerMensagemLoginFuncionario()">
                <!--Icone-->
                <div id="botao_mudancaLoginFuncionario" style="background-color:<?php echo($corQuartenaria); ?>;">
                    <img src="../img/funcionarioLogin.png" alt="">
                </div>
                <!--Texto-->
                <div id="textoBotao_mudancaLoginFuncionario" style="background-color:<?php echo($corPrimaria); ?>; color:<?php echo($corSecundaria); ?>;">
                    Funcionário
                </div>
            </div>
        </div>
    </div>
</div>
